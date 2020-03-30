// tailwind.config.js
module.exports = {
    theme: {},
    variants: {},
    plugins: [
        require('@tailwindcss/custom-forms'),
        require('@tailwindcss/ui')({
            layout: 'sidebar'
        }),
    ],
};
