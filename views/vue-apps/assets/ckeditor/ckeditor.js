import { ClassicEditor } from "@ckeditor/ckeditor5-editor-classic"; 
import {Alignment} from "@ckeditor/ckeditor5-alignment";
import {BlockQuote} from "@ckeditor/ckeditor5-block-quote";
import {Heading} from "@ckeditor/ckeditor5-heading";
import {Bold, Italic, Underline} from '@ckeditor/ckeditor5-basic-styles';
import {Link, LinkImage} from '@ckeditor/ckeditor5-link';
import {Paragraph} from '@ckeditor/ckeditor5-paragraph';
import {CodeBlock} from "@ckeditor/ckeditor5-code-block";
import {Highlight} from "@ckeditor/ckeditor5-highlight";
import {HtmlEmbed} from "@ckeditor/ckeditor5-html-embed";
import {
    Image,
    ImageCaption,
    ImageInsert,
    ImageResize,
    ImageStyle,
    ImageToolbar,
    ImageUpload,
} from "@ckeditor/ckeditor5-image";
import {List, ListProperties} from "@ckeditor/ckeditor5-list";
import {SourceEditing} from "@ckeditor/ckeditor5-source-editing";
import {Table} from "@ckeditor/ckeditor5-table";
import {TableToolbar} from "@ckeditor/ckeditor5-table";
import {Essentials} from "@ckeditor/ckeditor5-essentials";
import {HorizontalLine} from "@ckeditor/ckeditor5-horizontal-line";
import {FontFamily, FontSize} from "@ckeditor/ckeditor5-font";
import './translations/fa.js'

// Import other plugins as needed


export const plugins = [
    Alignment,
    BlockQuote,
    Bold,
    CodeBlock,
    Essentials,
    FontFamily,
    FontSize,
    Heading,
    Highlight,
    HorizontalLine,
    HtmlEmbed,
    Image,
    ImageCaption,
    ImageInsert,
    ImageResize,
    ImageStyle,
    ImageToolbar,
    ImageUpload,
    LinkImage,
    Italic,
    Link,
    List,
    ListProperties,
    Paragraph,
    SourceEditing,
    Table,
    TableToolbar,
    Underline,
];

export const toolbar = {
    items: [
        'heading',
        // 'fontFamily',
        'fontSize',
        '|',
        'bold',
        'alignment',
        'bulletedList',
        // TODO: direction
        '|',
        // 'imageInsert',
        'insertTable',
        'link',
        'htmlEmbed',
        'blockQuote',
        'codeBlock',
        '|',
        'highlight',
        'sourceEditing',
        '|',
        'undo',
        'redo'
    ],
    shouldNotGroupWhenFull: false
};

const textOptions = {
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


function initializeEditors() {
    // Load the translation file dynamically

    document.querySelectorAll('textarea.editor, textarea.mini-editor').forEach(textarea => {
        // Initialize CKEditor with custom configuration and translation
        
        ClassicEditor
            .create(textarea,  {
                ...textOptions,
                // translations: translation.default, // Use the loaded translation file
                toolbar,
                plugins: plugins,
                // initialData:<h2>hi</h2>,
                // placeholder: 'Type or paste your content here!',
            })
            .catch(error => {
                console.error(error);
            });
    });
}
document.addEventListener('DOMContentLoaded', function() {
    initializeEditors();
});