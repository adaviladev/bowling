#!/usr/bin/env bash

# Add file names here. Arrays in Bash do not use a comma
# Separate items with a new line
declare -a HOOK_FILES=(
	"pre-commit"
)

for i in "${HOOK_FILES[@]}"
do
	if [ ! -f ".git/hooks/$i" ]; then
		ln -s "../../$i.sh" ".git/hooks/$i"
	fi

	if [ ! -f "$i.sh" ]; then
		touch "./$i.sh";
	fi
    chmod +x "$i.sh"
done
