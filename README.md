# Setup
1. Install Vagrant/Homestead by following the [Laravel installation documentation](https://laravel.com/docs/5.6)
2. `vagrant up`
3. Checkout and branch out form `staging` by running the following commands:
    ```
    git checkout staging
    git branch feature/<your-feature>
    ```

## Coding Standard
- Your code must conform to the PSR-1/PSR-2 standard.
- All tests must pass before making a PR.
- All methods must have full DocBlocks.
- All method parameters must have type hints
