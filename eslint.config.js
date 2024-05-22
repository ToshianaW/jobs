import js from "@eslint/js";
import ts from "typescript-eslint";
import pluginVue from "eslint-plugin-vue";

export default [
    js.configs.recommended,
    ...ts.configs.recommended,
    ...pluginVue.configs['flat/recommended'],
    {
        plugins: {
            'typescript-eslint': ts.plugin
        },
        languageOptions: {
            parserOptions: {
                parser: ts.parser
            }
        },
        rules: {
            'vue/multi-word-component-names': 'off'
        },
        ignores: ['node_modules/*', 'public/*', 'vendor/*']
    },
];
