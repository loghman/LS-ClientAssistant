import { ClassicEditor } from "@ckeditor/ckeditor5-editor-classic";
import { miniToolbar, textToolbar, toolbar } from "./ck-toolbars.js";
import { miniPlugins, plugins, textPlugins } from "./ck-plugins.js";
import { miniOptions, options, textOptions } from "./ck-options.js";
import './translations/fa.js'

export const editorConfig = {
    plugins: plugins,
    toolbar: toolbar,
    ...options,
    fileUploadAdapter: {
        entity_type: '',
        entity_id: '',
        unique_id: ''
    }
    // initialData:<h2>hi</h2>,
    // placeholder: 'Type or paste your content here!',
}

export const miniEditorConfig = {
    plugins: miniPlugins,
    toolbar: miniToolbar,
    ...miniOptions,
    fileUploadAdapter: {
        entity_type: '',
        entity_id: '',
        unique_id: ''
    }
}

export const textEditorConfig = {
    plugins: textPlugins,
    toolbar: textToolbar,
    ...textOptions,
}
const setEditorUploadData = (config, elm) => {
    let newConfig = {};
    if (elm.getAttribute('data-et')) {
        const entity_type = elm.getAttribute('data-et');
        const entity_id = elm.getAttribute('data-ei');
        newConfig = { ...config, fileUploadAdapter: { entity_type, entity_id, unique_id: '' } }
    } else if (elm.getAttribute('data-unique_id')) {
        const unique_id = elm.getAttribute('data-unique_id');
        newConfig = { ...config, fileUploadAdapter: { entity_type:'', entity_id: '', unique_id: unique_id } }
    } else {
        console.error("media upload payload not set correctly");
    }
    return newConfig;
}

function initializeEditors() {
    document.querySelectorAll('textarea.editor').forEach(textarea => {
        // Initialize CKEditor with custom configuration and translation 
        const newConfig = setEditorUploadData(editorConfig, textarea);
        ClassicEditor.create(textarea, newConfig)
            .catch(error => {
                console.error(error);
            });
    });
    document.querySelectorAll('textarea.mini-editor').forEach(textarea => {
        const newConfig = setEditorUploadData(miniEditorConfig, textarea);
        ClassicEditor.create(textarea, newConfig).then(editor => {
            editor.editing.view.change(writer => {
                const editorRoot = editor.editing.view.document.getRoot();
                writer.setStyle('min-height', '150px', editorRoot);
            })
        }).catch(error => {
            console.error("mini-editor init error")
            console.error(error);
        });
    });
    document.querySelectorAll('textarea.text-editor').forEach(textarea => {
        ClassicEditor.create(textarea, textEditorConfig).then(editor => {
            editor.editing.view.change(writer => {
                const editorRoot = editor.editing.view.document.getRoot();
                writer.setStyle('min-height', '150px', editorRoot);
            })
        }).catch(error => {
            console.error("text-editor init error")
            console.error(error);
        });
    });
}
document.addEventListener('DOMContentLoaded', function () {
    initializeEditors();
});
