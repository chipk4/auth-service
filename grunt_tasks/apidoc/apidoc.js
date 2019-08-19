module.exports = function (artifactDir) {
  return {
    jsonapi_web: {
      src: 'manifests/jsonapi/apidoc/web',
      dest: artifactDir + '/frontend/jsonapi/apidoc/web',
      options: {
        config: 'manifests/jsonapi/apidoc/web/apidoc.json',
        debug: false
      }
    }
  }
}
