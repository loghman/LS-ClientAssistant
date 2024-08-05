import { request } from "../js/utilities/httpClient/httpClient";
import { uploadApi } from "../js/utilities/apiPath";

class CKEditorUploadAdapter {
    constructor(loader, options) {
        // The file loader instance to use during the upload.
        this.loader = loader;
        this.options = options;
    }

    // Starts the upload process.
    async upload() {
        try {
            const file = await this.loader.file;
            const response = await this.uploadFile(file);
            return { default: response?.result.url };
        } catch (error) {
            console.error(error);
            throw new Error("فایل آپلود نشد!");
        }
    }

    async uploadFile(file) {
        const loader = this.loader;
        const formData = new FormData();
        formData.append("file", file);
        formData.append("collection_name", "ckeditor");
         
        let url;
        if (this.options.entity_type) {
            url = uploadApi(
                'store',
                { entityType: this.options.entity_type, entityId: this.options.entity_id }
            );
            formData.append("clear_media", 0);
        } else if (this.options.unique_id) {
            url = uploadApi('fake_store');
            formData.append("unique_id", this.options.unique_id);
        } else {
            console.error("media upload payload not set correctly!");
            throw new Error("form data is invalid");
        }

        try {
            const response = await request("POST", url, formData, {
                headers: {
                    "Content-Type": false,
                    crossDomain: true,
                    processData: false,
                    "Access-Control-Allow-Credentials": false,
                },
                onUploadProgress: (evt) => {
                    if (evt.event.lengthComputable) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                }
            });

            const responseData = response.data;
            if (response.status) {
                console.log("uploaded");
                return responseData;   
            } else {
                console.log("upload failed"); 
            }
           
        } catch (error) {
            throw new Error(error.response?.data?.error?.message || "..آپلود انجام نشد!");
        }
    }

}

export function CKEditorUploadAdapterPlugin(editor) {
    editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
        const options = editor.config.get("fileUploadAdapter");

        // Configure the URL to the upload script in your back-end here!
        return new CKEditorUploadAdapter(loader, options);
    };
}
