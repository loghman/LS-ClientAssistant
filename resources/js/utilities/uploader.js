import { uploadApi } from "./apiPath";
import { post } from "./httpClient/httpClient";
import { messages } from "./static-messages";

const checkFileSize = (file, maxFileSize) => {
  const fileSizeInKB = file.size / 1024;

  if (maxFileSize && fileSizeInKB > maxFileSize) {
    toast(`فایل باید حداکثر ${maxFileSize}KB باشد`, "danger",5000,'',100);
    return false;
  }

  return true;
};

const checkAllowedFile = (type, allowedTypes) => {
// Extract both MIME type and extension
  const mimeType = type.split('/')[0]; // 'image' in 'image/jpeg'
  const fileExtension = type.split('/')[1]; // 'jpeg' in 'image/jpeg'
// Create a mapping of common extensions to their MIME types
  const extensionMap = {
    'jpg': 'jpeg',
    'jpeg': 'jpeg',
    // Add more as needed
  };

  // Check if either:
  // 1. The exact MIME type is allowed (e.g., 'image/jpeg')
  // 2. The extension part matches (e.g., 'jpeg')
  // 3. The mapped extension matches (e.g., 'jpg' → 'jpeg')
  const isAllowed = allowedTypes.some(allowed => {
    return (
        allowed === type || // Full MIME type match
        allowed === fileExtension || // Extension match
        (extensionMap[allowed] && extensionMap[allowed] === fileExtension) // Mapped extension
    );
  });

  if (!isAllowed) {
    toast(
        `نوع فایل باید یکی از موارد زیر باشد: ${allowedTypes.join(", ")}.`,
        "danger"
    );
  }

  return isAllowed;
};

document.addEventListener("DOMContentLoaded", function () {
  const uploaders = document.querySelectorAll(".uploader");

  const onUploadProgress = (progressEvent, progressBar, progressPercent) => {
    const { loaded, total } = progressEvent;
    let percent = Math.floor((loaded * 100) / total);

    if (percent <= 100 && progressBar && progressPercent) {
      progressPercent.classList.remove("d-none");
      progressBar.style.width = `${percent}%`;
      progressPercent.textContent = `% ${percent}`;
    } else {
      console.error("put upload-progress element beside input type file");
    }
  };

  uploaders.forEach((uploader) => {
    uploader.addEventListener("change", handleFileChange);
  });

  document.querySelectorAll('.cancel-upload')
      .forEach(function (elm) {
        elm.addEventListener('click', function () {
          const wrapper = this.parentElement.parentElement.parentElement.parentElement;
          wrapper.querySelector('.uploaded-file').classList.add('d-none');
          wrapper.querySelector('.uploading-box').classList.remove('d-none');
        })
      })

  async function handleFileChange(event) {
    const fileInput = event.target;
    const file = fileInput.files[0];

    if (!file) {
      toast(messages.CHOOSE_FILE, "danger");
      return;
    }

    const dataset = fileInput.dataset;
    let url;
    const maxSize = parseFloat(dataset.max_size);
    const allowedTypes = dataset.allowed_file?.split(",") || [];
    const isAllowedFile = allowedTypes.length === 0 || checkAllowedFile(file.type, allowedTypes);
    const isAllowedSize = !maxSize || checkFileSize(file, maxSize);

    if (!isAllowedFile || !isAllowedSize) return;

    if (dataset.unique_id) {
      url = uploadApi("fake_store");
    } else if (dataset.et && dataset.ei) {
      url = uploadApi("store", {
        entityType: dataset.et,
        entityId: dataset.ei,
      });
    } else {
      console.error("Invalid input media configuration for upload.");
      return;
    }

    await uploadFile(file, url, dataset, fileInput);
  }

  async function uploadFile(file, url, dataset, fileInput) {
    const progressBar = fileInput
        .closest("label")
        .querySelector(".progress-bar");
    const progressPercent = fileInput
        .closest("label")
        .querySelector(".progress-percent");
    try {
      const formData = new FormData();
      formData.append("file", file);

      if (dataset.collection_name) {
        formData.append("collection_name", dataset.collection_name);
      }
      if (dataset.unique_id) {
        formData.append("unique_id", dataset.unique_id);
      }
      if (dataset.media_custom_rule) {
        formData.append('media_custom_rule', dataset.media_custom_rule);
      }

      const response = await post(url, formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
        onUploadProgress: (event) =>
            onUploadProgress(event, progressBar, progressPercent),
      });

      if (response.success===true) {

        toast("فایل اپلود شد");

        if (progressBar && progressPercent) {
          progressPercent.classList.add("d-none");
          progressBar.style.width = "0%";
        }
        fileInput.value = "";

        const uploadedFile = fileInput.parentElement
            .parentElement.parentElement
            .querySelector('.uploaded-file');

        if (uploadedFile) {
          const fileParentElement = fileInput.parentElement.parentElement;
          fileParentElement.classList.add('d-none');
          uploadedFile.querySelector('input[type=hidden].response-value').value = response.result.id;

          if (response.result.type === 'image') {
            uploadedFile.querySelector('.file').innerHTML = '<img src="'+ response.result.small_thumbnail.url+'" />';
            uploadedFile.querySelector('.content .download-file').href = response.result.small_thumbnail.url;
          } else {
            uploadedFile.querySelector('.file').innerHTML = '<span class="type">'+ response.result.type +'</span>';
          }

          uploadedFile.classList.remove('d-none');
        }
      } else {
        toast(
            response.message.text
                ? response.message.text
                : messages.SOMETHING_WENT_WRONG,
            "danger"
        );
        if (progressBar && progressPercent) {
          progressPercent.classList.add("d-none");
          progressBar.style.width = "0%";
        }
        fileInput.value = "";
      }
    } catch (error) {
      console.error("Error uploading file:", error);
      fileInput.value = "";
    }
  }
});
