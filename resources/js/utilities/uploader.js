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
  const fileType = type.split("/")[1];
  const isAllowed = allowedTypes.includes(fileType);

  if (!isAllowed) {
    toast(`نوع فایل باید ${allowedTypes.join(", ")} باشد.`, "danger");
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

      const response = await post(url, formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
        onUploadProgress: (event) =>
          onUploadProgress(event, progressBar, progressPercent),
      });

      if (response.status===true) {
        toast("فایل اپلود شد");

        if (progressBar && progressPercent) {
          progressPercent.classList.add("d-none");
          progressBar.style.width = "0%";
        }
        fileInput.value = "";
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
