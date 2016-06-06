#!/usr/bin/env bash

# Pretty printing functions
NORMAL=$(tput sgr0)
GREEN=$(tput setaf 2; tput bold)
YELLOW=$(tput setaf 3)
RED=$(tput setaf 1)

function echored() {
    echo -e "$RED$*$NORMAL"
}

function echogreen() {
    echo -e "$GREEN$*$NORMAL"
}

function echoyellow() {
    echo -e "$YELLOW$*$NORMAL"
}

if [ $# -lt 4 ]
  then
    echored "ERROR: not enough arguments supplied."
    echo "Usage: update_repository.sh *type* *repository_name* *repository_url* *repository_path*"
    echo "  - type: git, svn"
    echo "  - repository_name: name of the repository, used in console output"
    echo "  - repository_url: URL used to clone the repository"
    echo "  - repository_path: path used to store the local clone"
    exit 1
fi

repository_type="$1"
repository_name="$2"
repository_url="$3"
repository_path="$4"
current_dir=$(pwd)

case $repository_type in
    "git" | "svn")
        ;;
    *)
        echored "Unknown repository type: $repository_type"
        exit 1
        ;;
esac

if [ ! -d $repository_path ]
then
    echoyellow "\nFolder is missing: $repository_path"
    case $repository_type in
        "git")
            echogreen "Cloning Git repository: $repository_name"
            git clone $repository_url $repository_path
            ;;
        "svn")
            echogreen "Cloning SVN repository: $repository_name"
            svn checkout $repository_url $repository_path
            ;;
    esac
else
    case $repository_type in
        "git")
            echogreen "\nUpdating Git repository: $repository_name."
            cd $repository_path
            if git rev-parse;
            then
                git reset --hard
                git checkout master
                git pull origin master
            else
                echored "$repository_path exists but doesn't appear to be a working Git repository."
            fi
            cd $current_dir
            ;;
        "svn")
            echogreen "\nUpdating SVN repository: $repository_name."
            if svn info $repository_path;
            then
                svn update $repository_path
            else
                echored "$repository_path exists but doesn't appear to be a working SVN repository."
            fi
            ;;
    esac
fi
