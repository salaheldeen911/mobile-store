/*
 * 'Highly configurable' mutable plugin boilerplate
 * Author: @markdalgleish
 * Further changes, comments: @addyosmani
 * Licensed under the MIT license
 */

// Note that with this pattern, as per Alex Sexton's, the plugin logic
// hasn't been nested in a jQuery plugin. Instead, we just use
// jQuery for its instantiation.

; (function ($, window, document, undefined) {

    let newSpry = $.extend({}, Spry),
        _this,
        validations = {},
        hasErrors = false;

    newSpry.Widget.ValidationTextField.onloadDidFire = true;
    newSpry.Widget.ValidationTextField.ONSUBMIT = 4;

    $("#spry").attr('novalidate', true);
    $("#createProduct").submit(function (e) {
    
        e.preventDefault();
        // console.log(_this.spryValidate())
        // Test_Handle('#sprySubmitBtn');
        return _this.spryValidate();
    
    });

    const isObject = (item) => {
        return (item && typeof item === 'object' && !Array.isArray(item));
    }

    /**
     * Deep merge two objects.
     * @param target
     * @param ...sources
     */
    const mergeDeep = (target, ...sources) => {
        if (!sources.length) return target;
        const source = sources.shift();

        if (isObject(target) && isObject(source)) {
            for (const key in source) {
                if (isObject(source[key])) {
                    if (!target[key]) Object.assign(target, { [key]: {} });
                    mergeDeep(target[key], source[key]);
                } else {
                    Object.assign(target, { [key]: source[key] });
                }
            }
        }
        return mergeDeep(target, ...sources);
    }

    // our plugin constructor
    let Plugin = function (elem, options) {

        this.elem = elem;
        this.$elem = $(elem);
        this.options = options;
        _this = this;


        // This next line takes advantage of HTML5 data attributes
        // to support customization of the plugin on a per-element
        // basis. For example,
        // <div class=item' data-plugin-options='{"message":"Goodbye World!"}'></div>
        // this.metadata = this.$elem.data( 'plugin-options' );
    };

    // the plugin prototype
    Plugin.prototype = {
        container_ids: [],
        defaults: {
            none: {
                validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
                isRequired: false, // Boolean
                // minChars: value, // Positive integer value
                // maxChars: value, // Positive integer value
                // hint : "write something...!" // optional
            },
            username: {
                validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
                isRequired: false, // Boolean
                // minChars: value, // Positive integer value
                // maxChars: value, // Positive integer value
                minAlphaChars: 4,
                maxAlphaChars: 6,
                startAlphaChars: 2,
                // hint : "write something...!" // optional
            },
            integer: {
                validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
                isRequired: true, // Boolean
                useCharacterMasking: false, // Boolean
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
                useCharacterMasking: false, // Boolean
                format: "dd/mm/yyyy", // (other varieties): "mm/dd/yyyy"; "yyyy-mm-dd"; "dd/mm/yy"; "yy/mm/dd"; "mm/dd/yy"; "dd-mm-yy"; "yyyy-mm-dd"; "mm.dd.yyyy"; "dd.mm.yyyy";
                // minValue: vlaue, // Date value in the specified format
                // maxValue: value, // Date value in the specified format
                hint: "11/09/1989" // optional

            },
            time: {
                format: "HH:mm", // (other varieties): "HH:mm:ss"; "hh:mm tt"; "hh:mm:ss tt"; "hh:mm t"; "hh:mm;ss t"; (where "tt" stands for am/pm format, and "t" stands for a/p format.)
                validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
                useCharacterMasking: false, // Boolean
                isRequired: true, // Boolean
                // minValue: vlaue, // Time value in the specified format
                // maxValue: value, // Time value in the specified format
                hint: "HH:mm", // optional

            },
            credit_card: {
                // format: // No format (the default) -- (other varieties): "visa"; "mastercard"; "amex"; "discover"; "dinersclub"
                useCharacterMasking: false, // Boolean
                validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
                isRequired: true, // Boolean
                // minChars: value, // Positive integer value
                // maxChars: value // Positive integer value
            },
            zip_code: {
                format: 'zip_custom', // (other varieties): "zip_us5" (the default); "zip_us9"; "zip_uk"; "zip_canada"; "zip_custom"
                validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
                isRequired: true, // Boolean
                pattern: "000-00", // Custom zip code pattern. Used when format="zip_custom"
                hint: "002-03", // optional
                useCharacterMasking: false, // Boolean
                // minChars: value, // Positive integer value
                // maxChars: value // Positive integer value
            },
            phone_number: {
                validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
                format: 'phone_custom', // (other varieties): "phone_number" (the default);
                pattern: "000-000-000-00", // Custom phone pattern. Used when format="phone_custom"
                isRequired: true, // Boolean
                useCharacterMasking: false, // Boolean
                hint: "012-735-428-01", // optional
                // minChars: value, // Positive integer value
                // maxChars: value // Positive integer value
            },
            social_security_number: {
                validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
                isRequired: true, // Boolean
                useCharacterMasking: false, // Boolean
                pattern: "000 000 000 000", // Custom social security pattern
                // minChars: value, // Positive integer value
                // maxChars: value, // Positive integer value
                hint: "000 000 000 000" // optional
            },
            currency: {
                format: "comma_dot", // (other varieties): "dot_comma"
                validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
                isRequired: true, // Boolean
                useCharacterMasking: false, // Boolean
                // minValue: vlaue, // Numeric value with two decimal numbers allowed
                // maxValue: value, // Numeric value with two decimal numbers allowed
            },
            real: {
                validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
                isRequired: true, // Boolean
                useCharacterMasking: false, // Boolean
                // minValue: vlaue, // Numeric value with decimal numbers
                // maxValue: value, // Numeric value with decimal numbers
            },
            ip: {
                format: "ipv4", // (other varieties): "ipv6"; "ipv4_ipv6"
                validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
                isRequired: true, // Boolean
                useCharacterMasking: false, // Boolean
            },
            url: {
                validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
                isRequired: true, // Boolean
                // minChars: value, // Positive integer value
                // maxChars: value // Positive integer value
                hint: "http://www.example.com" // optional
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
                validateOn: ['blur', 'change'], // (other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
                isRequired: true, // Boolean
                useCharacterMasking: true, // Boolean
                // minChars: value, // Positive integer value
                // maxChars: value // Positive integer value
                // counterType:"chars_remaining", // optional
                // counterId:"my_counter_span", // optional
                hint: "Enter your address here" // optional
            },
            custom: {
                validateOn: ['blur', 'change'], // (Other varieties): ["blur"]; ["change"]; or both together (["blur", "change"])
                isRequired: true, // Positive integer value
                useCharacterMasking: true, // boolean
                // pattern : null, // It is vary
                // hint: null, // It is vary
            },

            // Modify your errors here
            errorMessages: {
                required: "A value is required", // Comes when data-spry = "text" , "password", "confirm", "textarea" or "custom"
                invalid: "Invalid value", // Comes when data-spry = "text" or "custom"
                maxValue: "The maximum value exceeded", // Comes when data-spry = "text" or "custom"
                minValue: "The minimum value not met", // Comes when data-spry = "text" or "custom"
                maxChars: "The maximum number of characters exceeded", // Comes when data-spry = "text" , "password", "textarea" or "custom"
                minChars: "The minimum number of characters not met", // Comes when data-spry = "text" , "password", "confirm", "textarea" or "custom"
                maxAlphaChars: "The maximum number of alpha characters exceeded", // Comes when data-spry = "text" , "password", "textarea" or "custom"
                minAlphaChars: "The minimum number of alpha characters not met", // Comes when data-spry = "text" , "password", "confirm", "textarea" or "custom"
                startAlphaChars: `The start must contain at least number alpha characters`,
                makeSelection: "Please make a selection", // Comes when data-spry = "checkbox" , "radio" or "select"
                invalidSelection: "Invalid selection", // Comes when data-spry = "select"
                passwordStrength: "The password strength condition not met", // Comes when data-spry = "password"
                passwordCustom: "User defined condition not met", // Comes when data-spry = "password"
                invalidConfirm: "The values do not match" // Comes when data-spry = "confirm"
            }
        },

        init: function () {
            // Introduce defaults that can be extended either
            // globally or using an object literal.

            this.defaults = mergeDeep(this.defaults, this.options);

            // Sample usage:
            // Set the message per instance:
            // $('#elem').plugin({ message: 'Goodbye World!'});
            // or
            // var p = new Plugin(document.getElementById('elem'),
            // { message: 'Goodbye World!'}).init()
            // or, set the global default message:
            // Plugin.defaults.message = 'Goodbye World!'
            this.initSpry();

            return this;
        },

        // check the validation status
        spryValidation: function (key) {
            if (!validations[key].validate()) {
                hasErrors = true;
            }
        },

        getHtmlOptions: function (input, defaultOptions) {
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
            let textOptions = { ...defaultOptions, ...htmlOptions }

            return textOptions;
        },

        initSpry: function () {
            let idToConfirm = "";

            this.$elem.find(":input").each(function () {
                if (!this.dataset.spry) return;
                _this.container_id = "spryContainer-" + Math.random().toString(16).slice(2);
                _this.container_ids.push(_this.container_id);

                let elem = this;
                let $elem = $(this);

                let type = elem.dataset.spry;
                let method = elem.dataset.method;
                let id2 = Math.random().toString(16).slice(4);
                let parentClassName = elem.parentElement.className;
                let parentNodeName = elem.parentElement.nodeName;

                let spryHint = "";
                let spryType = elem.dataset.spry;
                let spryId = _this.container_id;

                let sprySettings = _this.defaults[spryType];

                if (parentClassName !== "spryValidate" && parentNodeName !== "SPAN") {
                    switch (type) {
                        case "select":
                            // selectpicker case
                            if ($elem.parent().is('div.dropdown.bootstrap-select.spryValidation')) {

                                $elem.wrap(`<span id ="${_this.container_id}" class = "spryValidate" data-spry = ${type} ></span>`).after(`
                                            <span class="selectRequiredMsg">${_this.defaults.errorMessages.makeSelection}</span>
                                            <span class="selectInvalidMsg">${_this.defaults.errorMessages.invalidSelection}</span>
                                        `);

                                let spryContainer = document.getElementById(this.container_id)

                                let sellectpickerSpryGuide = `<span id='${id2}' style='display:none;'></span>`
                                let next = $(spryContainer).next();
                                if (next.is('button.btn.dropdown-toggle')) {
                                    $(`#${_this.container_id}`).insertAfter($(next));
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
                                $elem.wrap(`<span id ="${_this.container_id}" class = "spryValidate" data-spry = ${type} ></span>`).after(`
                                            <span class="selectRequiredMsg">${_this.defaults.errorMessages.makeSelection}</span>
                                            <span class="selectInvalidMsg">${_this.defaults.errorMessages.invalidSelection}</span>
                                        `);
                            }

                            validations[spryId] = new newSpry.Widget.ValidationSelect(spryId, sprySettings);
                            break;
                        case "password":
                            $elem.wrap(`<span id ="${_this.container_id}" class = "spryValidate" data-spry = ${type} ></span>`).after(`
                                        <span class="passwordRequiredMsg">${_this.defaults.errorMessages.required}</span>
                                        <span class="passwordMinCharsMsg">${_this.defaults.errorMessages.minChars}</span>
                                        <span class="passwordMaxCharsMsg">${_this.defaults.errorMessages.maxChars}</span>
                                        <span class="passwordInvalidStrengthMsg">${_this.defaults.errorMessages.passwordStrength}</span>
                                        <span class="passwordCustomMsg">${_this.defaults.errorMessages.passwordCustom}</span>
                                    `);

                            validations[spryId] = new newSpry.Widget.ValidationPassword(spryId, sprySettings);
                            idToConfirm = validations[spryId].input.id
                            break;
                        case "confirm":
                            $elem.wrap(`<span id ="${_this.container_id}" class = "spryValidate" data-spry = ${type}  ></span>`).after(`
                                        <span class="confirmRequiredMsg">${_this.defaults.errorMessages.required}</span>
                                        <span class="confirmInvalidMsg">${_this.defaults.errorMessages.invalidConfirm}</span>
                                    `);
                            validations[spryId] = new newSpry.Widget.ValidationConfirm(spryId, idToConfirm, sprySettings);
                            break;
                        case "textarea":
                            $elem.wrap(`<span id ="${_this.container_id}" class = "spryValidate" data-spry = ${type} ></span>`).after(`
                                        <span id="my_counter_span"></span>
                                        <span class="textareaRequiredMsg">${_this.defaults.errorMessages.required}</span>
                                        <span class="textareaMinCharsMsg">${_this.defaults.errorMessages.minChars}</span>
                                        <span class="textareaMaxCharsMsg">${_this.defaults.errorMessages.maxChars}</span>
                                    `);

                            if (sprySettings.hint) {
                                spryHint = sprySettings.hint;
                                sprySettings.hint = "";
                                $elem.attr('placeholder', spryHint);
                                validations[spryId] = new newSpry.Widget.ValidationTextarea(spryId, sprySettings);
                                sprySettings.hint = spryHint;
                            } else {
                                validations[spryId] = new newSpry.Widget.ValidationTextarea(spryId, sprySettings);
                            }
                            break;
                        case "radio":
                            $elem.wrap(`<span id ="${_this.container_id}" class = "spryValidate" data-spry = ${type} ></span>`).after(`
                                        <span class="radioRequiredMsg">${_this.defaults.errorMessages.makeSelection}</span> 
                                    `);

                            validations[spryId] = new newSpry.Widget.ValidationRadio(spryId, sprySettings);
                            break;
                        case "checkbox":
                            $elem.wrap(`<span id ="${_this.container_id}" class = "spryValidate" data-spry = ${type} ></span>`).after(`
                                        <span class="checkboxRequiredMsg">${_this.defaults.errorMessages.makeSelection}</span>
                                    `);

                            validations[spryId] = new newSpry.Widget.ValidationCheckbox(spryId, sprySettings);
                            break;
                        case "custom":
                            $elem.wrap(`<span id = ${elem.dataset.id ? elem.dataset.id : ""} class = "spryValidate" data-spry = ${type}></span>`).after(`
                                        <span class="textfieldRequiredMsg">${_this.defaults.errorMessages.required}</span>
                                        <span class="textfieldInvalidFormatMsg">${_this.defaults.errorMessages.invalid}</span>
                                        <span class="textfieldMaxValueMsg">${_this.defaults.errorMessages.maxValue}</span>
                                        <span class="textfieldMinValueMsg">${_this.defaults.errorMessages.minValue}</span>
                                        <span class="textfieldMaxCharsMsg">${_this.defaults.errorMessages.maxChars}</span>
                                        <span class="textfieldMinCharsMsg">${_this.defaults.errorMessages.minChars}</span>
                                    `);

                            if (custom[spryId]) {
                                if (custom[spryId].hint) {
                                    spryHint = custom[spryId].hint
                                    custom[spryId].hint = false;
                                }

                                if (spryHint) {
                                    $elem.attr('placeholder', spryHint);
                                    custom[spryId].hint = spryHint;
                                }

                                validations[spryId] = new newSpry.Widget.ValidationTextField(spryId, "custom", custom[spryId]);

                            } else {
                                console.log(`"#${spryId}" error : check the custom object!!!`);
                                if (spryHint) {
                                    $elem.attr('placeholder', spryHint);
                                }

                                validations[spryId] = new newSpry.Widget.ValidationTextField(spryId, "none", sprySettings.none);
                                if (spryHint) {
                                    sprySettings.none.hint = spryHint;
                                }
                            }
                            break;
                        default:
                            $elem.wrap(`<span id ="${_this.container_id}" class = "spryValidate" data-spry = ${type} data-method = ${method} ></span>`).after(`
                                        <span class="textfieldRequiredMsg">${_this.defaults.errorMessages.required}</span>
                                        <span class="textfieldInvalidFormatMsg">${_this.defaults.errorMessages.invalid}</span>
                                        <span class="textfieldMaxValueMsg">${_this.defaults.errorMessages.maxValue}</span>
                                        <span class="textfieldMinValueMsg">${_this.defaults.errorMessages.minValue}</span>
                                        <span class="textfieldMaxCharsMsg">${_this.defaults.errorMessages.maxChars}</span>
                                        <span class="textfieldMinCharsMsg">${_this.defaults.errorMessages.minChars}</span>
                                        <span class="textfieldMaxAlphaCharsMsg">${_this.defaults.errorMessages.maxAlphaChars}</span>
                                        <span class="textfieldMinAlphaCharsMsg">${_this.defaults.errorMessages.minAlphaChars}</span>
                                        <span class="textfieldStartAlphaCharsMsg">${_this.defaults.errorMessages.startAlphaChars}</span>
                                    `);

                            let textOptions = sprySettings;
                            let spryInput = $(`#${_this.container_id}`).find('input')[0];
                            if (textOptions) {
                                let spryTextHint = null
                                if (textOptions.hint) {
                                    spryTextHint = textOptions.hint;
                                    textOptions.hint = "";
                                }
                                textOptions = _this.getHtmlOptions(spryInput, textOptions);
                                validations[spryId] = new newSpry.Widget.ValidationTextField(spryId, spryType, textOptions);

                                if (spryTextHint) {
                                    spryInput.placeholder = spryTextHint;
                                    textOptions.hint = spryHint;
                                    _this.defaults[spryType].hint = spryTextHint
                                    spryTextHint = null;
                                }
                            } else {
                                console.log(spryType)
                                if (_this.defaults[spryType].hint) {
                                    spryHint = this.defaults[spryType].hint;
                                    sprySettings.none.hint = "";
                                }
                                validations[spryId] = new newSpry.Widget.ValidationTextField(spryId, "none", sprySettings.none);

                                if (spryHint) {
                                    validations[spryId].input.placeholder = spryHint;
                                    _this.defaults[spryType].none.hint = spryHint;
                                }
                            }
                    }
                }
            })
        },
    }

    Plugin.defaults = Plugin.prototype.defaults;

    $.fn.plugin = function (options) {
        return this.each(function () {
            new Plugin(this, options).init();
        });
    };

    //optional: window.Plugin = Plugin;

})(jQuery, window, document);