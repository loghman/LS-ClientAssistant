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

/**
 * Mapping of allowed file types to their valid extensions.
 * Each type key corresponds to extensions that should be accepted.
 */
const FILE_TYPE_EXTENSIONS = Object.freeze({
  // Images
  png: ['png'],
  jpg: ['jpg', 'jpeg', 'jpe', 'jif', 'jfif'],
  
  // Archives
  zip: ['zip', 'zipx', '7z', 'rar', 'tar', 'gz', 'tgz', 'bz2', 'xz', 'tar.gz', 'tar.bz2'],
  
  // Documents
  pdf: ['pdf'],
  txt: ['txt', 'text', 'log'],
  md: ['md', 'markdown', 'mdown', 'mkd'],
  
  // Microsoft Word
  doc: ['doc'],
  docm: ['docm'],
  docx: ['docx'],
  
  // Microsoft PowerPoint
  ppt: ['ppt'],
  pptm: ['pptm'],
  pptx: ['pptx'],
  
  // Video
  mp4: ['mp4', 'm4v', 'mp4v'],
  mkv: ['mkv'],
  avi: ['avi'],
  
  // Audio
  mp3: ['mp3', 'm4a', 'mp3a'],
});

/**
 * Extracts file extension from filename.
 * Handles edge cases like no extension, hidden files, and multiple dots.
 * @param {string} fileName - The name of the file
 * @returns {string} - Lowercase extension without dot, or empty string
 */
const getFileExtension = (fileName) => {
  if (!fileName || typeof fileName !== 'string') return '';
  
  const lastDotIndex = fileName.lastIndexOf('.');
  if (lastDotIndex === -1 || lastDotIndex === 0) return '';
  
  return fileName.slice(lastDotIndex + 1).toLowerCase();
};

/**
 * Builds a Set of all allowed extensions based on selected file types.
 * @param {string[]} allowedTypes - Array of type keys (e.g., ['png', 'zip'])
 * @returns {Set<string>} - Set of all valid extensions
 */
const buildAllowedExtensions = (allowedTypes) => {
  const extensions = new Set();
  
  for (const type of allowedTypes) {
    const typeKey = type.toLowerCase().trim();
    const typeExtensions = FILE_TYPE_EXTENSIONS[typeKey];
    
    if (typeExtensions) {
      typeExtensions.forEach(ext => extensions.add(ext));
    }
  }
  
  return extensions;
};

/**
 * Formats allowed types for display in error message.
 * @param {string[]} allowedTypes - Array of type keys
 * @returns {string} - Formatted string for display
 */
const formatAllowedTypes = (allowedTypes) => {
  return allowedTypes
    .map(type => type.toUpperCase())
    .join('، ');
};

/**
 * Checks if a file is allowed based on its extension.
 * @param {string} fileName - The name of the file being uploaded
 * @param {string[]} allowedTypes - Array of allowed type keys from data-allowed_file
 * @returns {boolean} - True if file is allowed, false otherwise
 */
const checkAllowedFile = (fileName, allowedTypes) => {
  if (!allowedTypes || allowedTypes.length === 0) return true;
  
  const fileExtension = getFileExtension(fileName);
  
  if (!fileExtension) {
    toast('فایل انتخاب شده فاقد پسوند معتبر است.', 'danger');
    return false;
  }
  
  const allowedExtensions = buildAllowedExtensions(allowedTypes);
  
  if (allowedExtensions.size === 0) {
    console.warn('No valid file types configured in allowed_file attribute.');
    return true;
  }
  
  const isAllowed = allowedExtensions.has(fileExtension);
  
  if (!isAllowed) {
    toast(
      `فرمت فایل مجاز نیست. فرمت‌های قابل قبول: ${formatAllowedTypes(allowedTypes)}`,
      'danger'
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
    const isAllowedFile = allowedTypes.length === 0 || checkAllowedFile(file.name, allowedTypes);
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
