# Setup
1. Install Vagrant/Homestead by following the [Laravel installation documentation](https://laravel.com/docs/5.6)
2. `vagrant up`
3. Run the following commands:
```shell script
art migrate --seed
art passport:install
```
3. Checkout and branch form `staging` by running the following commands:
    ```
    git checkout staging
    git branch feature/<your-feature>
    ```

## Coding Standard
- Your code must comply with the local `phpcs.xml` and `tslint.json` files.
- All tests must pass before making a PR.

## Design
[Color Interpolation](https://jsfiddle.net/002v98LL/)  
[Coolers](https://coolors.co/dc3545-ee7b26-ffc107-94b426-28a745)

# Troubleshooting
## TypeError: Super expression must either be null or a function
- Error when running `npm run test`  
  - Comment out the line that is indicated: Most likely `node_modules/@vue/component-compiler-utils/node_modules/prettier/router.ts:40358`
