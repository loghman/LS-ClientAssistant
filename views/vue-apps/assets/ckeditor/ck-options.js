import {CKEditorUploadAdapterPlugin} from "./uploader-adapter";
export const options = {
    contentsLangDirection: 'rtl',
    language: 'fa',
    fontFamily: {
        options: [
            'default',
            'Ubuntu, Arial, sans-serif',
            'Ubuntu Mono, Courier New, Courier, monospace'
        ],
        supportAllValues: true
    },
    fontSize: {
        options: [
            '10',
            '12',
            '14',
            'default',
            '18',
            '20',
            '22',
        ]
    },
    image: {
        upload: {
            types: ['jpeg', 'png', 'jpg', 'gif', 'webp', 'svg'],
        },
        toolbar: [
            'imageTextAlternative',
            'toggleImageCaption',
            'linkImage',
            '|',
            'imageStyle:inline',
            {
                name: 'wrapImage',
                title: 'تصویر شناور',
                items: [
                    'imageStyle:alignRight',
                    'imageStyle:alignLeft',
                ],
                defaultItem: 'imageStyle:alignRight'
            },
            {
                name: 'breakText',
                title: 'تصویر تمام عرض',
                items: [
                    'imageStyle:alignBlockRight',
                    'imageStyle:alignBlockLeft',
                    'imageStyle:alignCenter',
                ],
                defaultItem: 'imageStyle:alignCenter'
            },
        ]
    },
    video: {
        upload: {
            types: ['mp4'],
        }
    },
    alignment: {
        options: [
            {name: 'left', className: 'ltr'},
            {name: 'right', className: 'rtl'},
            {name: 'center', className: 'text-center'},
            {name: 'justify', className: 'text-justify'},
        ]
    },
    heading: {
        options: [
            {model: 'paragraph', title: 'Paragraph'},
            {model: 'heading1', view: 'h1', title: 'Heading 1'},
            {model: 'heading2', view: 'h2', title: 'Heading 2'},
            {model: 'heading3', view: 'h3', title: 'Heading 3'},
            {model: 'heading4', view: 'h4', title: 'Heading 4'},
            {model: 'heading5', view: 'h5', title: 'Heading 5'},
            {model: 'heading6', view: 'h6', title: 'Heading 6'},
        ]
    },
};
export const miniOptions = {
    contentsLangDirection: 'rtl',
    language: 'fa',
    extraPlugins: [CKEditorUploadAdapterPlugin],
    fontFamily: {
        options: [
            'default',
            'Ubuntu, Arial, sans-serif',
            'Ubuntu Mono, Courier New, Courier, monospace'
        ],
        supportAllValues: true
    },
    fontSize: {
        options: [
            '10',
            '12',
            '14',
            'default',
            '18',
            '20',
            '22',
        ]
    },
    image: {
        upload: {
            types: ['jpeg', 'png', 'jpg', 'gif', 'webp', 'svg'],
        },
        toolbar: [
            'imageTextAlternative',
            'toggleImageCaption',
            'linkImage',
            '|',
            'imageStyle:inline',
            {
                name: 'wrapImage',
                title: 'تصویر شناور',
                items: [
                    'imageStyle:alignRight',
                    'imageStyle:alignLeft',
                ],
                defaultItem: 'imageStyle:alignRight'
            },
            {
                name: 'breakText',
                title: 'تصویر تمام عرض',
                items: [
                    'imageStyle:alignBlockRight',
                    'imageStyle:alignBlockLeft',
                    'imageStyle:alignCenter',
                ],
                defaultItem: 'imageStyle:alignCenter'
            },
        ]
    },
    alignment: {
        options: [
            {name: 'left', className: 'ltr'},
            {name: 'right', className: 'rtl'},
            {name: 'center', className: 'text-center'},
            {name: 'justify', className: 'text-justify'},
        ]
    },
    heading: {
        options: [
            { model: 'paragraph', title: 'Paragraph' },
            { model: 'heading1', view: 'h1', title: 'Heading 1' },
            { model: 'heading2', view: 'h2', title: 'Heading 2' },
            { model: 'heading3', view: 'h3', title: 'Heading 3' },
            { model: 'heading4', view: 'h4', title: 'Heading 4' },
            { model: 'heading5', view: 'h5', title: 'Heading 5' },
            { model: 'heading6', view: 'h6', title: 'Heading 6' },
        ]
    },
};
export const textOptions = {
    contentsLangDirection: 'rtl',
    language: 'fa',
    fontFamily: {
        options: [
            'default',
            'Ubuntu, Arial, sans-serif',
            'Ubuntu Mono, Courier New, Courier, monospace'
        ],
        supportAllValues: true
    },
    fontSize: {
        options: [
            '10',
            '12',
            '14',
            'default',
            '18',
            '20',
            '22',
        ]
    },
    alignment: {
        options: [
            {name: 'left', className: 'ltr'},
            {name: 'right', className: 'rtl'},
            {name: 'center', className: 'text-center'},
            {name: 'justify', className: 'text-justify'},
        ]
    },
    heading: {
        options: [
            { model: 'paragraph', title: 'Paragraph' },
            { model: 'heading1', view: 'h1', title: 'Heading 1' },
            { model: 'heading2', view: 'h2', title: 'Heading 2' },
            { model: 'heading3', view: 'h3', title: 'Heading 3' },
            { model: 'heading4', view: 'h4', title: 'Heading 4' },
            { model: 'heading5', view: 'h5', title: 'Heading 5' },
            { model: 'heading6', view: 'h6', title: 'Heading 6' },
        ]
    },
};