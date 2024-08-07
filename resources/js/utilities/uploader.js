import { uploadApi } from "./apiPath";
import { post } from "./httpClient/httpClient";
import { messages } from "./static-messages";

document.addEventListener('DOMContentLoaded', function () {
  const uploaders = document.querySelectorAll('.uploader');

  uploaders.forEach(uploader => {
    uploader.addEventListener('change', handleFileChange);
  });

  async function handleFileChange(event) {
    const fileInput = event.target;
    const file = fileInput.files[0];
    let url;
    if (!file) {
      toast(messages.CHOOSE_FILE, 'danger')
      return
    };

    const dataset = fileInput.dataset;

    if (dataset.unique_id) {
      url = uploadApi('fake_store');
      await uploadFile(file, url, dataset);
    } else if (dataset.et && dataset.ei) {
      url = uploadApi(
        'store',
        { entityType: dataset.et, entityId: dataset.ei }
      );
      await uploadFile(file, url, dataset);
    } else {
      console.error('Invalid input media configuration for upload.');
    }
  }

  async function uploadFile(file, url, dataset) {
    try {
      const formData = new FormData();
      formData.append('file', file);
      if (dataset.collection_name) {
        formData.append("collection_name", dataset.collection_name);
      }
      if (dataset.unique_id) {
        formData.append("unique_id", dataset.unique_id);
      }

      const response = await post(url, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          //  crossDomain: true,
        }
      });
      if (response.status) {
        toast('فایل اپلود شد')
      } else {
        toast(response.message.text ? response.message.text : messages.SOMETHING_WENT_WRONG, 'danger')
      }
    } catch (error) {
      console.error("Error uploading file to", error);
    }
  }
});