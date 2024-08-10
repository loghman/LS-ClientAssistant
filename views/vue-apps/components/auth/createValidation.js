import * as yup from 'yup';


export const createValidationSchema = (priority) => {
    const schemaObject = {};
        // if (priority==='password') {
        //      schemaObject['password'] = yup.string().required(`وارد کردن این گزینه الزامی است.`);
        // }else{
        //      schemaObject['uniqueKey'] = yup.string().matches(new RegExp(priority.field.validation.pattern), priority.field.validation.message);///this is better : /([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})|(09[0-9]{9})/
        // }
    return yup.object(schemaObject);
};
export const createFieldsValidationSchema = (fields) => {
    const schemaObject = {};
    if (typeof fields === 'object' && !Array.isArray(fields) && fields !== null) {
        fields = Object.values(fields);
    }

    fields.forEach(field => {
        let validator = yup.string();

        if (field.require) {
            validator = validator.required('وارد کردن این گزینه الزامی است.');
            
            if (field.validation && field.validation.pattern){
                validator.matches(new RegExp(field.validation.pattern), field.validation.message);
            }
            
        }

      if (!field.require && field.validation && field.validation.pattern) {
            validator = validator.matches(new RegExp(field.validation.pattern), field.validation.message);
        }

        schemaObject[field.name] = validator;
    });
    return yup.object().shape(schemaObject);
};
export const createRetriveValidationSchema = () => {
    return yup.object({
        code: yup.string().required('کد تایید الزامی است'),
        // password: yup
        //     .string()
        //     .required('رمز عبور الزامی است'),
        repeat_password: yup
            .string()
            // .required('تکرار رمز عبور الزامی است')
            .oneOf([yup.ref('password'), null], 'رمز عبور و تکرار آن باید یکسان باشند')
    });
};