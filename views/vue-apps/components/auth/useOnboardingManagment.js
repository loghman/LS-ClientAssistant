// useAuth.js
import { ref } from "vue";
import { uploadApi } from "@/js/utilities/apiPath";
import { post } from "@/js/utilities/httpClient/httpClient";

export const useOnboardingManagment = () => {
    const uploadPercent = ref(0);
    const avatarUrl = ref(null);
    const onUploadProgress = (progressEvent) => {
        const { loaded, total } = progressEvent;
        let percent = Math.floor((loaded * 100) / total);
        if (percent <= 100) {
            uploadPercent.value = percent;
        }
    };
    const uploadMedia = async ( formData, uploadUrl) => {
        try {
            const res = await post(uploadUrl, formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
                onUploadProgress,
            });
            if (res.status) {
                avatarUrl.value = res.result.url;
                uploadPercent.value = 0;
                toast("با موفقیت آپلود شد.");
            } else {
                uploadPercent.value = 0;
                toast(res.message.text,'danger');
            }
        } catch (error) {
            uploadPercent.value = 0;
            console.error(error)
        }
    };
    const handleUploadFile = async (file,entityId,entityType) => {
        if (file === null) {
            toast("فایل را انتخاب کنید.", "danger");
            return;
        }
        const formData = new FormData();
        formData.append("file", file);
         const  uploadUrl = uploadApi("store", {
            entityType:entityType,
            entityId:entityId,
        });
        uploadMedia( formData, uploadUrl);
    };
    return {
        handleUploadFile,
        uploadPercent,
        avatarUrl,
    };
};
