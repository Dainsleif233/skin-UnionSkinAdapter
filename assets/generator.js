document.querySelectorAll('pre').forEach(function (el) {
  if (window.hljs) {
    window.hljs.highlightElement(el)
  }
})

function downloadExtraList(filename, entry) {
  const a = document.createElement('a')
  const blob = new Blob([JSON.stringify(entry)], { type: 'application/json' })
  a.download = filename
  a.href = URL.createObjectURL(blob)
  a.click()
  a.remove()
}

document
  .querySelector('#download-extra-list-union')
  ?.addEventListener('click', function () {
    downloadExtraList('Union.json', {
      name: 'Union',
      type: 'MojangAPI',
      apiRoot: 'https://skin.mualliance.ltd/api/union/yggdrasil/api/',
      sessionRoot:
        'https://skin.mualliance.ltd/api/union/yggdrasil/sessionserver/',
    })
  })

document
  .querySelector('#download-extra-list-site')
  ?.addEventListener('click', function () {
    downloadExtraList(globalThis.blessing.site_name + '.json', {
      name: globalThis.blessing.site_name,
      type: 'CustomSkinAPI',
      root: globalThis.blessing.base_url + '/csl/',
    })
  })
