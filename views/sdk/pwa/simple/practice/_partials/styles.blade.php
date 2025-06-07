<style>
    /* Questions Container */
    .questions-container {
        background-color: transparent;
        padding: 10px;
        min-height: 230px;
        margin-bottom: 10px;
    }

    /* Question Section */
    .question-section {
        background: #fff;
        border: 1px solid var(--primary-20);
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        line-height: 1.7;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: box-shadow 0.2s ease;
    }
    @media (min-width: 200px) {
        .bottom-nav {
            display: flex !important;
        }
    }
    .question-section:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .question-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .question-number {
        color: var(--primary);
        font-size: 16px;
        font-weight: bold;
    }

    .question-point {
        color: var(--primary-90);
        font-size: 14px;
        font-weight: 500;
    }

    .question-text {
        font-size: 16px;
        line-height: 1.8;
        color: #333;
        margin-bottom: 16px;
    }

    /* Attachment Styles */
    .attachment-box {
        background-color: #f8f9fa;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        transition: background-color 0.2s;
        margin-bottom: 8px;
    }

    .attachment-box:hover {
        background-color: #e9ecef;
    }

    .attachment-icon {
        font-size: 24px;
    }

    .attachment-info {
        flex: 1;
    }

    .attachment-name {
        font-weight: 500;
        color: #333;
    }

    .attachment-size {
        font-size: 12px;
        color: #666;
    }

    /* Answer Section */
    .answer-section {
        margin-top: 16px;
    }

    .section-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 16px;
        color: #2c3e50;
    }

    /* Form Elements */
    .editor-content {
        width: 100%;
        min-height: 150px;
        padding: 12px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background-color: #fafafa;
        font-family: inherit;
        font-size: 14px;
        line-height: 1.5;
        color: #333;
        resize: vertical;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .editor-content:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(var(--primary-rgb), 0.1);
    }

    .editor-content::placeholder {
        color: #999;
    }

    .editor-content:disabled {
        background-color: #f5f5f5;
        color: #666;
        cursor: not-allowed;
        border-color: #ddd;
    }

    /* File Upload */
    .file-upload {
        margin-bottom: 16px;
    }

    .upload-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        background-color: #f8f9fa;
        border: 1px dashed var(--primary);
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        color: var(--primary);
        transition: background-color 0.2s;
    }

    .upload-btn:hover {
        background-color: var(--primary-15);
    }

    .selected-file {
        margin-top: 8px;
        font-size: 14px;
        color: #666;
    }

    /* Submit Button */
    .submit-btn {
        width: 100%;
        padding: 14px;
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
        position: relative;
    }

    .submit-btn:hover {
        background-color: var(--primary-dark);
    }

    .submit-btn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    /* Submitted Answer */
    .submitted-answer {
        background-color: #f8f9fa;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 16px;
    }

    .answer-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .answer-date {
        font-size: 14px;
        color: #666;
    }

    .answer-status {
        padding: 4px 12px;
        border-radius: 16px;
        font-size: 14px;
        font-weight: 500;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-accepted {
        background-color: #d4edda;
        color: #155724;
    }

    .status-rejected {
        background-color: #f8d7da;
        color: #721c24;
    }

    .submitted-form {
        margin-bottom: 12px;
    }

    /* File Link Styles */
    .file-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        background-color: var(--primary-15);
        border: 1px solid var(--primary);
        border-radius: 6px;
        color: var(--primary);
        text-decoration: none;
        font-size: 14px;
        transition: background-color 0.2s;
    }

    .file-link:hover {
        background-color: var(--primary-20);
    }

    .file-icon {
        font-size: 16px;
    }

    /* Feedback Section */
    .feedback-box {
        background-color: var(--primary-15);
        border: 1px solid var(--primary);
        border-radius: 8px;
        padding: 16px;
        margin-top: 12px;
    }

    .feedback-title {
        font-weight: bold;
        color: var(--primary);
        margin-bottom: 8px;
    }

    .feedback-content {
        color: #333;
        line-height: 1.6;
    }

    .score {
        font-weight: bold;
        color: var(--primary);
        font-size: 18px;
    }

    /* Correct Answer Section */
    .correct-answer-section {
        background-color: #e8f5e8;
        border: 1px solid #4CAF50;
        border-radius: 8px;
        padding: 16px;
        margin-top: 16px;
    }

    .correct-answer-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
    }

    .correct-icon {
        font-size: 20px;
    }

    .correct-title {
        font-weight: bold;
        color: #2e7d32;
        font-size: 16px;
    }

    .correct-answer-content {
        line-height: 1.8;
        color: #333;
        margin-bottom: 12px;
    }

    .answer-author {
        display: flex;
        align-items: center;
        gap: 8px;
        padding-top: 12px;
        border-top: 1px solid #c8e6c9;
    }

    .author-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
    }

    .author-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .author-name {
        font-weight: 500;
        color: #2e7d32;
        font-size: 14px;
    }

    .answer-date {
        font-size: 12px;
        color: #666;
    }

    /* Navigation Styles */
    .flex {
        display: flex;
    }

    .items-center {
        align-items: center;
    }

    .gap-base {
        gap: var(--base-gap);
    }

    .justify-start {
        justify-content: flex-start;
    }

    .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .flex-1 {
        flex: 1;
    }

    .text-primary {
        color: var(--primary);
    }

    /* Button Styles */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 16px;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        background-color: var(--primary);
        color: white;
    }

    .btn.light {
        background-color: #fff;
        border: 1px solid var(--primary-20);
        color: var(--primary);
    }

    .btn.light:hover {
        background-color: var(--primary-15);
        border-color: var(--primary);
    }

    .btn:hover {
        background-color: var(--primary-dark);
    }

    .bottom-video {
        flex-direction: column-reverse;
        gap: calc(var(--base-padding) / 2);
        padding-top: var(--base-padding);
    }

    .bottom-video > * {
        width: 100%;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .question-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .bottom-video {
            flex-direction: column;
            gap: calc(var(--base-padding) / 2);
            padding-top: var(--base-padding);
        }

        .bottom-video > * {
            width: 100%;
        }
    }
</style> 