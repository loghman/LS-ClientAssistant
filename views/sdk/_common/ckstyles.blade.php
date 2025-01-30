/**
* @license Copyright (c) 2003-2024, CKSource Holding sp. z o.o. All rights reserved.
* For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
*/
:root {
	--ck-color-mention-background: rgba(153, 0, 48, .1);
	--ck-color-mention-text: #990030
}

.ck-content .mention {
	background: var(--ck-color-mention-background);
	color: var(--ck-color-mention-text)
}

.ck-content code {
	background-color: hsla(0, 0%, 78%, .3);
	border-radius: 2px;
	padding: .15em
}

.ck-content blockquote {
    border: 1px solid #e7e7e7;
    border-right: 5px solid #ccc;
    overflow: hidden;
    background: #fff;
    padding: 10px 15px;
    border-radius: 5px;
}

.ck-content pre {
	background: hsla(0, 0%, 78%, .3);
	border: 1px solid #c4c4c4;
	border-radius: 2px;
	color: #353535;
	direction: ltr;
	font-style: normal;
	min-width: 200px;
	padding: 1em;
	tab-size: 4;
	text-align: left;
	white-space: pre-wrap
}

.ck-content pre code {
	background: unset;
	border-radius: 0;
	padding: 0
}

.ck-content .text-tiny {
	font-size: .7em
}

.ck-content .text-small {
	font-size: .85em
}

.ck-content .text-big {
	font-size: 1.4em
}

.ck-content .text-huge {
	font-size: 1.8em
}

:root {
	--ck-highlight-marker-yellow: #fdfd77;
	--ck-highlight-marker-green: #8bf98b;
	--ck-highlight-marker-pink: #ffaec2;
	--ck-highlight-marker-blue: #85d3fd;
	--ck-highlight-pen-red: #e71313;
	--ck-highlight-pen-green: #128a00
}

.ck-content [class^="marker-"] {
    border-radius: 2px;
    padding: 0px 3px;
}
.ck-content .marker-yellow {
	background-color: var(--ck-highlight-marker-yellow)
}

.ck-content .marker-green {
	background-color: var(--ck-highlight-marker-green)
}

.ck-content .marker-pink {
	background-color: var(--ck-highlight-marker-pink)
}

.ck-content .marker-blue {
	background-color: var(--ck-highlight-marker-blue)
}

.ck-content .pen-red {
	background-color: transparent;
	color: var(--ck-highlight-pen-red)
}

.ck-content .pen-green {
	background-color: transparent;
	color: var(--ck-highlight-pen-green)
}

.ck-content hr {
	background: #dedede;
	border: 0;
	height: 4px;
	margin: 15px 0
}

:root {
	--ck-color-image-caption-background: #f7f7f7;
	--ck-color-image-caption-text: #333
}

.ck-content .image>figcaption {
	background-color: var(--ck-color-image-caption-background);
	caption-side: bottom;
	color: var(--ck-color-image-caption-text);
	display: table-caption;
	font-size: .75em;
	outline-offset: -1px;
	padding: .6em;
	word-break: break-word
}

@media (forced-colors:active) {
	.ck-content .image>figcaption {
		background-color: unset;
		color: unset
	}
}

.ck-content img.image_resized {
	height: auto
}

.ck-content .image.image_resized {
	box-sizing: border-box;
	display: block;
	max-width: 100%
}

.ck-content .image.image_resized img {
	width: 100%
}

.ck-content .image.image_resized>figcaption {
	display: block
}

:root {
	--ck-image-style-spacing: 1.5em;
	--ck-inline-image-style-spacing: calc(var(--ck-image-style-spacing)/2)
}

.ck-content .image.image-style-block-align-left,
.ck-content .image.image-style-block-align-right {
	max-width: calc(100% - var(--ck-image-style-spacing))
}

.ck-content .image.image-style-align-left,
.ck-content .image.image-style-align-right {
	clear: none
}

.ck-content .image.image-style-side {
	float: right;
	margin-left: var(--ck-image-style-spacing);
	max-width: 50%
}

.ck-content .image.image-style-align-left {
	float: left;
	margin-right: var(--ck-image-style-spacing)
}

.ck-content .image.image-style-align-right {
	float: right;
	margin-left: var(--ck-image-style-spacing)
}

.ck-content .image.image-style-block-align-right {
	margin-left: auto;
	margin-right: 0
}

.ck-content .image.image-style-block-align-left {
	margin-left: 0;
	margin-right: auto
}

.ck-content .image-style-align-center {
	margin-left: auto;
	margin-right: auto
}

.ck-content .image-style-align-left {
	float: left;
	margin-right: var(--ck-image-style-spacing)
}

.ck-content .image-style-align-right {
	float: right;
	margin-left: var(--ck-image-style-spacing)
}

.ck-content p+.image.image-style-align-left,
.ck-content p+.image.image-style-align-right,
.ck-content p+.image.image-style-side {
	margin-top: 0
}

.ck-content .image-inline.image-style-align-left,
.ck-content .image-inline.image-style-align-right {
	margin-bottom: var(--ck-inline-image-style-spacing);
	margin-top: var(--ck-inline-image-style-spacing)
}

.ck-content .image-inline.image-style-align-left {
	margin-right: var(--ck-inline-image-style-spacing)
}

.ck-content .image-inline.image-style-align-right {
	margin-left: var(--ck-inline-image-style-spacing)
}

.ck-content .image {
	clear: both;
	display: table;
	margin: .9em auto;
	min-width: 50px;
	text-align: center
}

.ck-content .image img {
	display: block;
	height: auto;
	margin: 0 auto;
	max-width: 100%;
	min-width: 100%
}

.ck-content .image-inline {
	align-items: flex-start;
	display: inline-flex;
	max-width: 100%
}

.ck-content .image-inline picture {
	display: flex
}

.ck-content .image-inline img,
.ck-content .image-inline picture {
	flex-grow: 1;
	flex-shrink: 1;
	max-width: 100%
}

.ck-content ol {
	list-style-type: decimal
}

.ck-content ol ol {
	list-style-type: lower-latin
}

.ck-content ol ol ol {
	list-style-type: lower-roman
}

.ck-content ol ol ol ol {
	list-style-type: upper-latin
}

.ck-content ol ol ol ol ol {
	list-style-type: upper-roman
}

.ck-content ul {
	list-style-type: disc
}

.ck-content ul li {
    list-style-type: circle;
    display: list-item !important;
    font-size: 15px !important;
    font-weight: 400 !important;
    color: inherit !important;
} 

.ck-content ul ul {
	list-style-type: circle
}

.ck-content ul ul ul,
.ck-content ul ul ul ul {
	list-style-type: square
}

:root {
	--ck-todo-list-checkmark-size: 16px
}

.ck-content .todo-list {
	list-style: none
}

.ck-content .todo-list li {
	margin-bottom: 5px;
	position: relative
}

.ck-content .todo-list li .todo-list {
	margin-top: 5px
}

.ck-content .todo-list .todo-list__label>input {
	-webkit-appearance: none;
	border: 0;
	display: inline-block;
	height: var(--ck-todo-list-checkmark-size);
	left: -25px;
	margin-left: 0;
	margin-right: -15px;
	position: relative;
	right: 0;
	vertical-align: middle;
	width: var(--ck-todo-list-checkmark-size)
}

.ck-content[dir=rtl] .todo-list .todo-list__label>input {
	left: 0;
	margin-left: -15px;
	margin-right: 0;
	right: -25px
}

.ck-content .todo-list .todo-list__label>input:before {
	border: 1px solid #333;
	border-radius: 2px;
	box-sizing: border-box;
	content: "";
	display: block;
	height: 100%;
	position: absolute;
	transition: box-shadow .25s ease-in-out;
	width: 100%
}

@media (prefers-reduced-motion:reduce) {
	.ck-content .todo-list .todo-list__label>input:before {
		transition: none
	}
}

.ck-content .todo-list .todo-list__label>input:after {
	border-color: transparent;
	border-style: solid;
	border-width: 0 calc(var(--ck-todo-list-checkmark-size)/8) calc(var(--ck-todo-list-checkmark-size)/8) 0;
	box-sizing: content-box;
	content: "";
	display: block;
	height: calc(var(--ck-todo-list-checkmark-size)/2.6);
	left: calc(var(--ck-todo-list-checkmark-size)/3);
	pointer-events: none;
	position: absolute;
	top: calc(var(--ck-todo-list-checkmark-size)/5.3);
	transform: rotate(45deg);
	width: calc(var(--ck-todo-list-checkmark-size)/5.3)
}

.ck-content .todo-list .todo-list__label>input[checked]:before {
	background: #26ab33;
	border-color: #26ab33
}

.ck-content .todo-list .todo-list__label>input[checked]:after {
	border-color: #fff
}

.ck-content .todo-list .todo-list__label .todo-list__label__description {
	vertical-align: middle
}

.ck-content .todo-list .todo-list__label.todo-list__label_without-description input[type=checkbox] {
	position: absolute
}

.ck-content .media {
	clear: both;
	display: block;
	margin: .9em 0;
	min-width: 15em
}

.ck-content .page-break {
	align-items: center;
	clear: both;
	display: flex;
	justify-content: center;
	padding: 5px 0;
	position: relative
}

.ck-content .page-break:after {
	border-bottom: 2px dashed #c4c4c4;
	content: "";
	position: absolute;
	width: 100%
}

.ck-content .page-break__label {
	background: #fff;
	border: 1px solid #c4c4c4;
	border-radius: 2px;
	box-shadow: 2px 2px 1px rgba(0, 0, 0, .15);
	color: #333;
	display: block;
	font-family: Helvetica, Arial, Tahoma, Verdana, Sans-Serif;
	font-size: .75em;
	font-weight: 700;
	padding: .3em .6em;
	position: relative;
	text-transform: uppercase;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	z-index: 1
}

@media print {
	.ck-content .page-break {
		padding: 0
	}

	.ck-content .page-break:after {
		display: none
	}

	.ck-content:has(+.page-break) {
		margin-bottom: 0
	}
}

.ck-content .table {
	display: table;
	margin: .9em auto
}

.ck-content .table table {
	border: 1px double #b3b3b3;
	border-collapse: collapse;
	border-spacing: 0;
	height: 100%;
	width: 100%
}

.ck-content .table table td,
.ck-content .table table th {
	border: 1px solid #bfbfbf;
	min-width: 2em;
	padding: .4em
}

.ck-content .table table th {
	background: rgba(0, 0, 0, .05);
	font-weight: 700
}

@media print {
	.ck-content .table table {
		height: auto
	}
}

.ck-content[dir=rtl] .table th {
	text-align: right
}

.ck-content[dir=ltr] .table th {
	text-align: left
}

:root {
	--ck-color-selector-caption-background: #f7f7f7;
	--ck-color-selector-caption-text: #333
}

.ck-content .table>figcaption {
	background-color: var(--ck-color-selector-caption-background);
	caption-side: top;
	color: var(--ck-color-selector-caption-text);
	display: table-caption;
	font-size: .75em;
	outline-offset: -1px;
	padding: .6em;
	text-align: center;
	word-break: break-word
}

@media (forced-colors:active) {
	.ck-content .table>figcaption {
		background-color: unset;
		color: unset
	}
}

.ck-content .table .ck-table-resized {
	table-layout: fixed
}

.ck-content .table table {
	overflow: hidden
}

.ck-content .table td,
.ck-content .table th {
	overflow-wrap: break-word;
	position: relative
}


.ck-content .text-justify {
    text-align: justify;
}
.ck-content .text-center {
    text-align: justify;
}
.ck-content .text-left,.ltr {
    text-align: left;
}
.ck-content .text-right,.rtl {
    text-align: right;
}
.ck-content figure{
    margin:15px auto;
}
.ck-content figure,img{
    max-width: 100%;
    border-radius: 5px;
}
.ck-content figure.image {
    text-align: center;
}