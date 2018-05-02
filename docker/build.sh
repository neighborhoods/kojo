#!/bin/bash
set -euo pipefail
cd -P -- "$(dirname -- "$0")/.." # From https://stackoverflow.com/a/17744637

# Most things in Docker will be run as root
export COMPOSER_ALLOW_SUPERUSER=1

while [[ $# -gt 1 ]]; do
    case "$1" in
        --xdebug)
            INSTALL_XDEBUG="$2"
            shift
            ;;
        --composer-token)
            COMPOSER_TOKEN="$2"
            shift
            ;;
        --composer-install)
            COMPOSER_INSTALL="$2"
            shift
            ;;
        *)
            echo "Unknown option $1" 1>&2;
            exit 1
            ;;
    esac

    shift
done

# Support setting composer token via file
if [ -f "COMPOSER_GITHUB_TOKEN" ]; then
    COMPOSER_TOKEN=$(cat COMPOSER_GITHUB_TOKEN | tr -d '[:space:]')
fi

if [[ "$COMPOSER_TOKEN" == placeholder* ]]; then
    echo "Composer token must be set" 1>&2
    exit 1
fi

composer config -g github-oauth.github.com $COMPOSER_TOKEN

if [ -f "DEPLOY_KEY" ]; then
    echo "Installing deploy key"
    mkdir -p /root/.ssh
    ssh-keyscan github.com 2>/dev/null >> /root/.ssh/known_hosts
    cp DEPLOY_KEY /root/.ssh/id_rsa
    chmod 0600 /root/.ssh/id_rsa
fi

if [ "$COMPOSER_INSTALL" = true ]; then
    if [ -f "DEPLOY_KEY" ]; then
        echo "Updating composer.json to avoid Github API on private repos"
        mv composer.json composer-old.json
        jq '(.repositories[] | .["no-api"]? ) |= true' composer-old.json > composer.json
    fi

    echo "Installing composer dependencies..."
    composer install

    if [ -f "composer-old.json" ]; then
        echo "Restoring composer.json"
        mv composer-old.json composer.json
    fi
fi

# If we were passed composer token via file, unset the config so it isn't
# included in the Docker image
if [ -f "COMPOSER_GITHUB_TOKEN" ]; then
    echo "Composer token passed via file; unsetting config value"
    composer config -g --unset github-oauth.github.com
    rm COMPOSER_GITHUB_TOKEN
fi

# If we were passed composer token via file, unset the config so it isn't
# included in the Docker image
if [ -f "DEPLOY_KEY" ]; then
    echo "Deploy key passed via file; removing"
    rm -f /root/.ssh/id_rsa
    rm -f DEPLOY_KEY
fi

if [ "$INSTALL_XDEBUG" = true ]; then
    echo "Installing the xdebug extension..."
    pecl install xdebug-2.7.0alpha1
    docker-php-ext-enable xdebug
fi
