import * as yup from 'yup';


export const createValidationSchema = (fields) => {
    const schemaObject = {};
    fields.forEach(field => {
        schemaObject[field.name] = yup.string().required(`.وارد کردن این گزینه الزامی است.`).matches(new RegExp(field.validation.pattern), field.validation.message);///this is better : /^09[0-9]{9}$/
    });
    return yup.object(schemaObject);
};