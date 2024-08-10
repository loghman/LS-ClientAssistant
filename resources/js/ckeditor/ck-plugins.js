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
export const miniPlugins = [
    Alignment,
    Bold,
    CodeBlock,
    Essentials,
    FontFamily,
    FontSize,
    Heading,
    HorizontalLine,
    Image,
    ImageCaption,
    ImageInsert,
    ImageResize,
    ImageStyle,
    ImageToolbar,
    ImageUpload,
    Italic,
    Link,
    List,
    ListProperties,
    Paragraph,
    Table,
    TableToolbar,
    Underline,
];
export const textPlugins = [
    Alignment,
    Bold,
    CodeBlock,
    Essentials,
    FontFamily,
    FontSize,
    Heading,
    HorizontalLine,
    Italic,
    Link,
    List,
    ListProperties,
    Paragraph,
    Underline,
];