//find a way to get translated error messages


/**
 * class for form validation
 * @returns {Validator}
 */
var Validator = function () {
    this.sanitizeString = function () {};
    /**
     * 
     * @param {type} errorname the name of the error message so an ajax call can be made to get the translated message for the error
     * @returns {undefined}
     */
    this.getTranslatedErrorMessage = function (errorname, language) {
        return errorname;
    };
    this.validateLength = function (input) {
        //other validations
        if (typeof input.pattern !== "undefined") {
            var patternvalue = input.pattern.replace('.{', '')
            patternvalue = patternvalue.replace('}', '')
            var patternvaluearray = patternvalue.split(',');
            //get minlength of pattern  and check if length of value is smaller
            var minlength = patternvaluearray[0];
            if (input.value.trim().length < minlength) {
                return "value is too short";
            }
            // get maxlength of pattern if set and check if length of vlaue is bigger
            if (patternvaluearray[1] !== "") {
                var maxlength = patternvaluearray[1];
            }
            if (typeof maxlength !== "undefined" && input.value.trim().length > maxlength) {
                return "value is too long";
            }
        }
    };
    this.validatePattern = function (input) {
        var matches = input.value.match(input.pattern);
        if (!matches|| matches.length !== 1 || matches[0] !== input.value) {
            return "field not filled correctly";
        }
    };
    this.validateRequired = function (input) {
        if (input.required === true && (input.value === null || input.value.trim() === "")) {
            return "field is not filled";
        }
    };
    /**
     * validates files
     * @returns {Array}
     */
    this.validateFile = function () {
    };
};