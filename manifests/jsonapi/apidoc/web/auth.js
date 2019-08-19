/**
 * @api {post} /auth/login Login by nickname and password
 *
 * @apiVersion 0.1.1
 * @apiGroup Auth
 * @apiName LoginByNickname
 *
 * @apiUse RequestHeaders
 *
 * @apiUse JsonApiUnauthorizedError
 * @apiUse JsonApiForbiddenError
 * @apiUse JsonApiBadRequestError
 *
 * @apiParam {Object} data
 * @apiParam {Object} data.attributes Login attributes
 * @apiParam {String[6-32]} data.attributes.password User password
 * @apiParam {String[6-32]} data.attributes.nickname User nickname
 *
 * @apiParamExample {json} Login-Example:
 * {
 *   "data": {
 *     "type": "login-by-nickname",
 *     "attributes": {
 *       "nickname": "test_nick",
 *       "password": "example_password"
 *     }
 *   }
 * }
 *
 * @apiSuccessExample {json} LoginByNickname-Example:
 * HTTP/1.1 200 Ok
 * {
 *    "jsonapi": {
 *        "version": "1.0"
 *    },
 *    "data": {
 *        "type": "user",
 *        "id": "adfe3efsdg443dsf",
 *        "attributes": {
 *            "first_name": "Andrew",
 *            "last_name": "Kirito"
 *            "nick_name": "kiritos",
 *            "age": "33"
 *        }
 *    }
 *}
 *
 */

/**
 * @api {post} /auth/register Register user by nickname
 *
 * @apiVersion 0.0.1
 * @apiGroup Auth
 * @apiName SignUpByNickName
 *
 * @apiUse RequestHeaders
 *
 * @apiUse JsonApiForbiddenError
 * @apiUse JsonApiBadRequestError
 *
 * @apiParam {Object} data
 * @apiParam {String} data.type=user Resource type
 * @apiParam {Object} data.attributes
 * @apiParam {String} data.attributes.nickname User nickname
 * @apiParam {String} data.attributes.password User password
 * @apiParam {String} data.attributes.first_name User first name
 * @apiParam {String} data.attributes.last_name User last name
 * @apiParam {String} data.attributes.age User age
 *
 * @apiParamExample {json} Request Example:
 * {
 *   "data": {
 *     "type": "user",
 *     "attributes": {
 *       "nickname": "test_nick",
 *       "password": "q1w2e3",
 *       "first_name": "Other",
 *       "last_name" : "SEO",
 *       "age": "33"
 *     }
 *   }
 *  }
 * }
 *
 * @apiSuccess (Success 200) {Object} data
 * @apiSuccess (Success 200) {String} data.id User identification
 * @apiSuccess (Success 200) {Object} data.attributes
 * @apiSuccess (Success 200) {String} data.attributes.first_name User first name
 * @apiSuccess (Success 200) {String} [data.attributes.last_name] User last name
 * @apiSuccess (Success 200) {String} data.attributes.nick_name User nickname
 * @apiSuccess (Success 200) {String} data.attributes.age User age
 *
 * @apiSuccessExample {json} SignUpByNickname-Example:
 * HTTP/1.1 200 OK
 * {
 *   data: {
 *     "id": "sdfsdf",
 *     "type": "user",
 *     "attributes": {
 *        "name": "Andrew",
 *        "nick_name": "test_nick",
 *        "first_name": "Andrew",
 *        "last_name": "Chi",
 *        "age": "33"
 *     }
 *   }
 * }
 *
 */
