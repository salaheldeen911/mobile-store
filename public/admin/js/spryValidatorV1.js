/* jshint esversion: 6 */
"use strict";

// Modify your settings here
const DefultSprySettings = {
    text: {
        none: {
            validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
            isRequired: true, // Positive integer value
            // minChars: 5, // Positive integer value
            // maxChars: value, // Positive integer value
            // hint : "write something...!" // optional
        },
        integer: {
            validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
            isRequired: true, // Boolean
            useCharacterMasking: true, // Boolean
            // allowNegative: false, // Boolean
            // minValue: value, // Integer value
            // maxValue: value, // Integer value
            hint: "1234" // optional

        },
        email: {
            validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
            isRequired: true, // Boolean
            hint: "xxx@xxx.com", // optinal
            // minChars: value, // Positive integer value
            // maxChars: value // Positive integer value
        },
        date: {
            validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
            isRequired: true, // Boolean
            useCharacterMasking: true, // Boolean
            format: "dd/mm/yyyy", // (other varieties): "mm/dd/yyyy"; "yyyy-mm-dd"; "dd/mm/yy"; "yy/mm/dd"; "mm/dd/yy"; "dd-mm-yy"; "yyyy-mm-dd"; "mm.dd.yyyy"; "dd.mm.yyyy";
            // minValue: vlaue, // Date value in the specified format
            // maxValue: value, // Date value in the specified format
            hint: "11/09/1989" // optional

        },
        time: {
            format: "HH:mm", // (other varieties): "HH:mm:ss"; "hh:mm tt"; "hh:mm:ss tt"; "hh:mm t"; "hh:mm;ss t"; (where "tt" stands for am/pm format, and "t" stands for a/p format.)
            validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
            useCharacterMasking: true, // Boolean
            isRequired: true, // Boolean
            // minValue: vlaue, // Time value in the specified format
            // maxValue: value, // Time value in the specified format
            hint: "HH:mm", // optional

        },
        credit_card: {
            // format: "none"// No format (the default) -- (other varieties): "visa"; "mastercard"; "amex"; "discover"; "dinersclub"
            useCharacterMasking: true, // Boolean
            validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
            isRequired: true, // Boolean
            // minChars: value, // Positive integer value
            // maxChars: value // Positive integer value
        },
        zip_code: {
            format: 'zip_custom', // (recommended) (other varieties): "zip_us5" (the default); "zip_us9"; "zip_uk"; "zip_canada"; "zip_custom"
            validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
            isRequired: true, // Boolean
            pattern: "000-00", // Custom zip code pattern. Used when format="zip_custom"
            hint: "002-03", // optional
            useCharacterMasking: true, // Boolean 
            // minChars: value, // Positive integer value
            // maxChars: value // Positive integer value
        },
        phone_number: {
            validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
            format: 'phone_custom', // (recommended) (other varieties): "phone_number" (the default);
            pattern: "000-000-000-00", // Custom phone pattern. Used when format="phone_custom"
            isRequired: true, // false
            useCharacterMasking: true, // Boolean
            hint: "012-735-428-01", // optional
            // minChars: value, // Positive integer value
            // maxChars: value // Positive integer value
        },
        social_security_number: {
            validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
            isRequired: true, // Boolean
            useCharacterMasking: true, // Boolean
            pattern: "000 000 000 000", // Custom social security pattern
            // minChars: value, // Positive integer value
            // maxChars: value, // Positive integer value
            hint: "000 000 000 000" // optional
        },
        currency: {
            format: "comma_dot", // (other varieties): "dot_comma"
            validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
            isRequired: true, // Boolean
            useCharacterMasking: true, // Boolean
            // minValue: vlaue, // Numeric value with two decimal numbers allowed
            // maxValue: value, // Numeric value with two decimal numbers allowed
        },
        real: {
            validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
            isRequired: true, // Boolean
            useCharacterMasking: true, // Boolean
            // minValue: vlaue, // Numeric value with decimal numbers
            // maxValue: value, // Numeric value with decimal numbers
        },
        ip: {
            format: "ipv4", // (other varieties): "ipv6"; "ipv4_ipv6"
            validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
            isRequired: true, // Boolean
            useCharacterMasking: true, // Boolean
        },
        url: {
            validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
            isRequired: true, // Boolean
            // minChars: value, // Positive integer value
            // maxChars: value // Positive integer value
            hint: "http://www.example.com" // optional
        }
    },
    checkbox: {
        validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
        minSelections: 1, // Can be modefid by positive integer value
        maxSelections: 3, // Can be modefid by positive integer value
        isRequired: true // Boolean
    },
    radio: {
        validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
        isRequired: true // Boolean
    },
    select: {
        validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
        isRequired: true, // Boolean
        invalidValue: "-1" // optional
    },
    password: {
        validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
        isRequired: true, // Boolean
        // minChars:"none", // The minimum number of characters required for a valid password.
        // maxChars:"none", // The maximum allowable length of the password.
        // minAlphaChars:"none", // Minimum number of letters required for a password to be valid.
        // maxAlphaChars:"none", // Maximum number of letters required for a password to be valid.
        // minUpperAlphaChars:"none", // Minimum number of upper case letters required for a password to be valid.
        // maxUpperAlphaChars:"none", // Maximum number of upper case letters required for a password to be valid.
        // minSpecialChars:"none", // Minimum number of special characters required for a password to be valid.
        // maxSpecialChars:"none", // Maximum number of special characters required for a password to be valid.
        // minNumbers:"none", // Minimum number of numbers required for a password to be valid.
        minNumbers: 2, // Maximum number of numbers required for a password to be valid.
    },
    confirm: {
        validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
        isRequired: true, // Boolean
    },
    textarea: {
        validateOn: ['blur', 'change'], // (Other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
        isRequired: true, // Boolean
        useCharacterMasking: true, // Boolean
        // minChars: value, // Positive integer value
        // maxChars: value // Positive integer value
        // counterType:"chars_remaining", // optional
        // counterId:"my_counter_span", // Optional
        hint: "Enter your address here" // Optional
    },
    custom: {
        validateOn: ['blur', 'change'], // (Other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
        isRequired: true, // Positive integer value
        useCharacterMasking: true, // boolean
        // pattern : null, // It is vary
        // hint: null, // It is vary
    },

    // Modify your errors here
    errors: {
        required: "A value is required", // Comes when data-spry = "text" , "password", "confirm", "textarea" or "custom" 
        invalid: "Invalid value", // Comes when data-spry = "text" or "custom" 
        maxValue: "The maximum value exceeded", // Comes when data-spry = "text" or "custom" 
        minValue: "The minimum value not met", // Comes when data-spry = "text" or "custom" 
        maxChars: "The maximum number of characters exceeded", // Comes when data-spry = "text" , "password", "textarea" or "custom"  
        minChars: "The minimum number of characters not met", // Comes when data-spry = "text" , "password", "confirm", "textarea" or "custom" 
        makeSelection: "Please make a selection", // Comes when data-spry = "checkbox" , "radio" or "select"
        invalidSelection: "Invalid selection", // Comes when data-spry = "select"
        passwordStrength: "The password strength condition not met", // Comes when data-spry = "password"
        invalidConfirm: "The values do not match" // Comes when data-spry = "confirm"
    }
};

// Extend the Spry object to new object newSpray and manipulate the new one
let newSpry = $.extend({}, Spry);
newSpry.Widget.ValidationTextField.onloadDidFire = true;
newSpry.Widget.ValidationTextField.ONSUBMIT = 4;

// variables for validation
let validations = {};
let noErrors;

// Structure the dom
function initSpry(container, settings) {
    if (container.find(":input.spryValidation:not(div)")) {
        container.find(":input.spryValidation:not(div), span.spryValidation, select.spryValidation").each(function () {
            let parentClassName = this.parentElement.className;
            let parentNodename = this.parentElement.nodeName;

            if (parentClassName !== "spryValidate" && parentNodename !== "SPAN") {
                let type = this.dataset.spry;
                let method = this.dataset.method;
                let id = Math.random().toString(16).slice(2);
                let id2 = Math.random().toString(16).slice(4);

                switch (type) {
                    case "text":
                        $(this).wrap(`<span id = spryContainer-${id} class = "spryValidate" data-spry = ${type} data-method = ${method} ></span>`).after(`
                        <span class="textfieldRequiredMsg">${settings.errors.required}</span>
                        <span class="textfieldInvalidFormatMsg">${settings.errors.invalid}</span>
                        <span class="textfieldMaxValueMsg">${settings.errors.maxValue}</span>
                        <span class="textfieldMinValueMsg">${settings.errors.minValue}</span>
                        <span class="textfieldMaxCharsMsg">${settings.errors.maxChars}</span>
                        <span class="textfieldMinCharsMsg">${settings.errors.minChars}</span>
                    `);
                        break;
                    case "select":
                        // selectpicker case
                        if ($(this).parent().is('div.dropdown.spryValidation')) {

                            $(this).wrap(`<span id = spryContainer-${id} class = "spryValidate" data-spry = ${type} ></span>`).after(`
                            <span class="selectRequiredMsg">${settings.errors.makeSelection}</span>
                            <span class="selectInvalidMsg">${settings.errors.invalidSelection}</span>
                            `);

                            let spryContainer = document.getElementById(`spryContainer-${id}`)

                            let sellectpickerSpryGuide = `<span id='${id2}' style='display:none;'></span>`
                            let next = $(spryContainer).next();
                            if (next.is('button.btn.dropdown-toggle')) {
                                $(`#spryContainer-${id}`).insertAfter($(next));
                            }

                            if (!$(spryContainer).prev().prev().is(`span#${id2}`)) {
                                $(sellectpickerSpryGuide).insertBefore($(spryContainer).prev());
                            }

                            var observer = new MutationObserver(function (event) {
                                let targetClass = event.at(-1).target.className.split(/\s+/);

                                for (var i = 0; i < targetClass.length; i++) {

                                    if (targetClass[i] === 'selectRequiredState' || targetClass[i] === 'selectInvalidState') {

                                        if (!$(`#${id2}`).hasClass('selectInvalidState')) {
                                            $(`#${id2}`).addClass("selectInvalidState");
                                            $(`#${id2}`).removeClass("selectValidState");
                                        }
                                    } else {
                                        $(`#${id2}`).removeClass("selectInvalidState");
                                        $(`#${id2}`).addClass("selectValidState");
                                    }
                                }
                            })

                            observer.observe(spryContainer, {
                                attributes: true,
                                attributeFilter: ['class'],
                                childList: false,
                                characterData: false
                            })

                        } else {
                            // other cases
                            $(this).wrap(`<span id = spryContainer-${id} class = "spryValidate" data-spry = ${type} ></span>`).after(`
                            <span class="selectRequiredMsg">${settings.errors.makeSelection}</span>
                            <span class="selectInvalidMsg">${settings.errors.invalidSelection}</span>
                        `);
                        }
                        break;
                    case "password":
                        $(this).wrap(`<span id = spryContainer-${id} class = "spryValidate" data-spry = ${type} ></span>`).after(`
                        <span class="passwordRequiredMsg">${settings.errors.required}</span>
                        <span class="passwordMinCharsMsg">${settings.errors.minChars}</span>
                        <span class="passwordMaxCharsMsg">${settings.errors.maxChars}</span>
                        <span class="passwordInvalidStrengthMsg">${settings.errors.passwordStrength}</span>
                    `);
                        break;
                    case "confirm":
                        $(this).wrap(`<span id = spryContainer-${id} class = "spryValidate" data-spry = ${type}  ></span>`).after(`
                        <span class="confirmRequiredMsg">${settings.errors.required}</span>
                        <span class="confirmInvalidMsg">${settings.errors.invalidConfirm}</span>
                    `);
                        break;
                    case "textarea":
                        $(this).wrap(`<span id = spryContainer-${id} class = "spryValidate" data-spry = ${type} ></span>`).after(`
                        <span id="my_counter_span"></span>
                        <span class="textareaRequiredMsg">${settings.errors.required}</span>
                        <span class="textareaMinCharsMsg">${settings.errors.minChars}</span>
                        <span class="textareaMaxCharsMsg">${settings.errors.maxChars}</span>
                    `);
                        break;
                    case "radio":
                        $(this).wrap(`<span id = spryContainer-${id} class = "spryValidate" data-spry = ${type} ></span>`).after(`
                        <span class="radioRequiredMsg">${settings.errors.makeSelection}</span> 
                    `);
                        break;
                    case "checkbox":
                        $(this).wrap(`<span id = spryContainer-${id} class = "spryValidate" data-spry = ${type} ></span>`).after(`
                        <span class="checkboxRequiredMsg">${settings.errors.makeSelection}</span>
                    `);
                        break;
                    case "custom":
                        $(this).wrap(`<span id = ${this.dataset.id ? this.dataset.id : ""} class = "spryValidate" data-spry = ${type}></span>`).after(`
                        <span class="textfieldRequiredMsg">${settings.errors.required}</span>
                        <span class="textfieldInvalidFormatMsg">${settings.errors.invalid}</span>
                        <span class="textfieldMaxValueMsg">${settings.errors.maxValue}</span>
                        <span class="textfieldMinValueMsg">${settings.errors.minValue}</span>
                        <span class="textfieldMaxCharsMsg">${settings.errors.maxChars}</span>
                        <span class="textfieldMinCharsMsg">${settings.errors.minChars}</span>
                    `);
                        break;
                }
            }
        })
    }
};

// Get the html defult validation
function getHtmlOptions(input, defultOptions) {
    let htmlOptions = {};
    let inputAttribute = input.attributes;
    if (inputAttribute.maxlength) {
        htmlOptions.maxChars = inputAttribute["maxlength"].value
    }
    if (inputAttribute.minlength) {
        htmlOptions.minChars = inputAttribute["minlength"].value
    }
    if (inputAttribute.min) {
        htmlOptions.minValue = inputAttribute["min"].value
    }
    if (inputAttribute.max) {
        htmlOptions.maxValue = inputAttribute["max"].value
    }
    let textOptions = { ...defultOptions, ...htmlOptions }
    return textOptions;
}

// check the validation status
function spryValidation(key, input) {

    if (!validations[key].validate()) {
        noErrors = false;
    }
}


function isObject(item) {
    return (item && typeof item === 'object' && !Array.isArray(item));
}

function mergeDeep(target, ...sources) {
    if (!sources.length) return target;
    const source = sources.shift();
    if (isObject(target) && isObject(source)) {
        for (const key in source) {
            if (typeof source[key] === 'object') {
                if (!target[key]) Object.assign(target, { [key]: {} });
                mergeDeep(target[key], source[key]);
            } else {
                Object.assign(target, { [key]: source[key] });
            }
        }
    }
    return mergeDeep(target, ...sources);
}
$(document).ready(function(){
    let forms = document.getElementsByTagName('FORM');
    if (forms) {
        for (let form of forms) {
            form.setAttribute("novalidate", true)
        }
    }
})



// The main function
function spryValidate(container, custom, settings) {
    if (!container.length) { console.log("Can't find container element!"); return true; }
    if (!container.jquery) { container = $(container); }
    if (container.prop("tagName") == "FORM") { container.attr('novalidate', true); }

    !settings ? settings = DefultSprySettings : settings = mergeDeep(DefultSprySettings, settings)

    noErrors = true;

    initSpry(container, settings);

    let idToConfirm = "";
    let groups = container.find('span.spryValidate');

    if (groups) {
        groups.each(function () {
            let spryHint = "";
            let spryType = this.dataset.spry
            let spryId = this.id;
            let sprySettings = settings[spryType];
            let validateMethod = this.dataset.method;

            if (sprySettings) {

                switch (spryType) {
                    case "checkbox":
                        validations[spryId] = new newSpry.Widget.ValidationCheckbox(spryId, sprySettings);
                        break;
                    case "radio":
                        validations[spryId] = new newSpry.Widget.ValidationRadio(spryId, sprySettings);
                        break;
                    case 'select':
                        validations[spryId] = new newSpry.Widget.ValidationSelect(spryId, sprySettings);
                        break;
                    case 'password':
                        validations[spryId] = new newSpry.Widget.ValidationPassword(spryId, sprySettings);
                        idToConfirm = validations[spryId].input.id
                        break;
                    case 'confirm':
                        validations[spryId] = new newSpry.Widget.ValidationConfirm(spryId, idToConfirm, sprySettings);
                        break;
                    case 'textarea':
                        if (sprySettings.hint) {
                            spryHint = sprySettings.hint;
                            sprySettings.hint = "";
                            validations[spryId] = new newSpry.Widget.ValidationTextarea(spryId, sprySettings);
                            validations[spryId].input.placeholder = spryHint;
                            sprySettings.hint = spryHint;
                        } else {
                            validations[spryId] = new newSpry.Widget.ValidationTextarea(spryId, sprySettings);
                        }
                        break;
                    case 'text':
                        let textOptions = sprySettings[validateMethod];
                        let spryInput = $(this).find("input")[0];
                        if (textOptions) {
                            let spryTextHint = null
                            if (textOptions.hint) {
                                spryTextHint = textOptions.hint;
                                textOptions.hint = "";
                            }
                            textOptions = getHtmlOptions(spryInput, textOptions);
                            validations[spryId] = new newSpry.Widget.ValidationTextField(spryId, validateMethod, textOptions);
                            if (spryTextHint) {
                                spryInput.placeholder = spryTextHint;
                                textOptions.hint = spryHint;
                                settings.text[validateMethod].hint = spryTextHint
                                spryTextHint = null;
                            }
                        } else {
                            if (settings.text.none.hint) {
                                spryHint = settings.text.none.hint;
                                sprySettings.none.hint = "";
                            }
                            validations[spryId] = new newSpry.Widget.ValidationTextField(spryId, "none", sprySettings.none);

                            if (spryHint) {
                                validations[spryId].input.placeholder = spryHint;
                                settings.text.none.hint = spryHint;
                            }
                        }
                        break;
                    case 'custom':
                        if (custom[spryId]) {
                            if (custom[spryId].hint) {
                                spryHint = custom[spryId].hint
                                custom[spryId].hint = false;
                            }

                            let customSettings = { ...custom[spryId], ...sprySettings }
                            validations[spryId] = new newSpry.Widget.ValidationTextField(spryId, "custom", customSettings);
                            if (spryHint) {
                                validations[spryId].input.placeholder = spryHint;
                                // custom[spryId].hint = spryHint;
                            }
                        } else {
                            console.log(`"#${spryId}" error : check the custom object!!!`);
                            if (settings.text.none.hint) {
                                spryHint = settings.text.none.hint;
                                sprySettings.none.hint = "";
                            }
                            validations[spryId] = new newSpry.Widget.ValidationTextField(spryId, "none", settings.text.none);

                            if (spryHint) {
                                validations[spryId].input.placeholder = spryHint;
                                settings.text.none.hint = spryHint;
                            }
                        }
                        break;
                }

            } else {
                console.log("Your data-type atrribute is not valid!!");
                return true;
            }

            spryValidation(spryId, validations[spryId].input);

        })
    } else {
        console.log("No inputs to validate here!");
    }

    return !noErrors;
};