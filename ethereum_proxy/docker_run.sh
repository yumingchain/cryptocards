#!/usr/bin/env bash
case $1 in
    run)
		cd src
        go run GoRpc/server/main.go
        ;;
    *)
        exec "$@"
        ;;
esac
