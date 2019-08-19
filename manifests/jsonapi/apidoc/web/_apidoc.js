/**
 * @apiDefine RequestHeaders
 *
 * @apiHeader Content-Type=application/vnd.api+json
 * @apiHeader Accept=application/vnd.api+json
 *
 * @apiHeaderExample {json} RequestHeader-Example:
 * {
 *   Accept: application/vnd.api+json
 *   Content-Type: application/vnd.api+json
 * }
 */

/**
 * @apiDefine FileUploadHeader
 *
 * @apiHeaderExample {json} FileUploadHeader-Example:
 * {
 *   Content-Type: multipart/form-data
 * }
 */

/**
 * @apiDefine APIAcceptHeader
 *
 * @apiHeaderExample {json} APIAcceptHeader-Example:
 * {
 *   Accept: application/vnd.api+json
 * }
 */

/**
 * @apiDefine PaginationDefaultParameters
 *
 * @apiParam {Number} [per_page=10]
 * @apiParam {Boolean} [paginate=true]
 */

/**
 * @apiDefine SkipResponseDataAttribute
 *
 * @apiParam {Object} [meta] Contains request meta
 * @apiParam {Boolean} [meta.without_data=false] Skip <code>data</code> top-level attribute in response
 */

/**
 * @apiDefine NotFoundError
 *
 * @apiError (Error 4xx) {Int} status HTTP status of error
 * @apiError (Error 4xx) {String} [code] Internal system error code
 * @apiError (Error 4xx) {String} title Error title
 *
 * @apiErrorExample {json} NotFoundResponse-Example:
 * HTTP/1.1 404 Not Found
 * {
 *   status: 404,
 *   code: "string",
 *   title: "string"
 * }
 */

/**
 * @apiDefine JsonApiNotFoundError
 *
 * @apiError (Error 401) {Object[]} errors Array of errors
 * @apiError (Error 401) {String} errors.code Internal system error code
 * @apiError (Error 401) {String} errors.title Error title
 *
 * @apiErrorExample {json} NotFoundResponse-Example:
 * HTTP/1.1 404 Not Found
 * {
 *     "errors": [
 *         {
 *             "code": 404,
 *             "title": "Not Found"
 *         }
 *     ]
 * }
 */

/**
 * @apiDefine JsonApiBadRequestError
 *
 * @apiError (Error 400) {Object[]} errors Array of errors
 * @apiError (Error 400) {String} errors.code Internal system error code
 * @apiError (Error 400) {String} errors.title Error title
 *
 * @apiErrorExample {json} BadRequestError Example
 * HTTP/1.1 400 Bad Request
 * {
 *     "meta": {
 *         "show_recaptcha": false
 *     },
 *     "errors": [
 *         {
 *             "code": 400,
 *             "title": "The email has already been taken.",
 *             "source": {
 *                 "pointer": "/data/attributes/email"
 *             }
 *         }
 *     ]
 * }
 */

/**
 * @apiDefine UnauthorizedError
 *
 * @apiError (Error 4xx) {Int} status HTTP status of error
 * @apiError (Error 4xx) {String} [code] Internal system error code
 * @apiError (Error 4xx) {String} title Error title
 *
 * @apiErrorExample {json} UnauthorizedResponse-Example:
 * HTTP/1.1 401 Unauthorized
 * {
 *   status: 401,
 *   code: "string",
 *   title: "string"
 * }
 */

/**
 * @apiDefine ForbiddenError
 *
 * @apiError (Error 4xx) {String} [id] ID of error
 * @apiError (Error 4xx) {Int} status HTTP status of error
 * @apiError (Error 4xx) {String} [code] Internal system error code
 * @apiError (Error 4xx) {String} title Error title
 *
 * @apiErrorExample {json} ForbiddenResponse-Example:
 * HTTP/1.1 403 Forbidden
 * {
 *   id: "string|int",
 *   status: 403,
 *   code: "string",
 *   title: "string"
 * }
 */

/**
 * @apiDefine ValidationError
 *
 * @apiError (Error 4xx) {Int} status HTTP status of error
 * @apiError (Error 4xx) {String} [code] Internal system error code
 * @apiError (Error 4xx) {String} title Error title
 * @apiError (Error 4xx) {Object} source Validation error
 * @apiError (Error 4xx) {String} source.pointer JSON pointer to non-valid attribute
 *
 * @apiErrorExample {json} ValidationErrorResponse-Example:
 * HTTP/1.1 400 Bad Request
 * {
 *   status: 400,
 *   code: "string",
 *   title: "string",
 *   source: {
 *     pointer: "/data/attributes/field"
 *   }
 * }
 */

/**
 * @apiDefine MultipartFormValidationError
 *
 * @apiError (Error 4xx) {Int} status HTTP status of error
 * @apiError (Error 4xx) {String} [code] Internal system error code
 * @apiError (Error 4xx) {String} title Error title
 * @apiError (Error 4xx) {Object} source Validation error
 * @apiError (Error 4xx) {String} source.pointer JSON pointer to non-valid attribute
 *
 * @apiErrorExample {json} ValidationErrorResponse-Example:
 * HTTP/1.1 400 Bad Request
 * {
 *   status: 400,
 *   code: "string",
 *   title: "string",
 *   source: {
 *     pointer: "field"
 *   }
 * }
 */

/**
 * @apiDefine BadRequestError
 *
 * @apiError (Error 4xx) {Int} status HTTP status of error
 * @apiError (Error 4xx) {String} [code] Internal system error code
 * @apiError (Error 4xx) {String} title Error title
 *
 * @apiErrorExample {json} BadRequestResponse-Example:
 * HTTP/1.1 400 Bad Request
 * {
 *   status: 400,
 *   code: "string",
 *   title: "string"
 * }
 */

/**
 * @apiDefine TooManyRequestsError
 *
 * @apiErrorExample {json} TooManyRequestsResponse-Example:
 * HTTP/1.1 429 Too Many Requests
 */

/**
 * @apiDefine JsonApiUnauthorizedError
 *
 * @apiError (Error 401) {Object} [meta] Auth result metadata
 * @apiError (Error 401) {Boolean} [meta.show_recaptcha]  Need show ReCaptcha or not
 * @apiError (Error 401) {String="deleted","banned","normal","incomplete"} [meta.user_state]  State of auth attemt
 * @apiError (Error 401) {Object[]} errors Array of errors
 * @apiError (Error 401) {String} errors.code Internal system error code
 * @apiError (Error 401) {String} errors.title Error title
 *
 * @apiErrorExample {json} UnauthorizedResponse-Example:
 * HTTP/1.1 401 Unauthorized
 * {
 *     "meta": {
 *         "show_recaptcha": false,
 *         "user_state": "banned"
 *     },
 *     "errors": [
 *         {
 *             "code": 401,
 *             "title": "Unauthorized"
 *         }
 *     ]
 * }
 */

/**
 * @apiDefine JsonApiForbiddenError
 *
 * @apiError (Error 403) {Object[]} errors Array of errors
 * @apiError (Error 403) {String} errors.code Internal system error code
 * @apiError (Error 403) {String} errors.title Error title
 *
 * @apiErrorExample {json} ForbiddenError Example
 * HTTP/1.1 403 Forbidden
 * {
 *     "errors": [
 *         {
 *             "code": 403,
 *             "title": "Forbidden"
 *         }
 *     ]
 * }
 */
