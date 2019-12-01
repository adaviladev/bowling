module.exports = {
    root: true,

    env: {
        node: true
    },

    extends: ["plugin:vue/essential", "@vue/prettier", "@vue/typescript"],

    rules: {
      'no-console': 'warn',
      'no-debugger': 'warn',
    },

    parserOptions: {
        parser: '@typescript-eslint/parser'
    },

    overrides: [
        {
            files: [
                '**/tests/*.{j,t}s?(x)',
                '**/tests/unit/**/*.spec.{j,t}s?(x)'
            ],
            env: {
                jest: true
            }
        }
    ],

    'extends': [
      'plugin:vue/essential',
      '@vue/prettier',
      '@vue/typescript'
    ]
};
