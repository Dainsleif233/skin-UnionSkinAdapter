import hljs from 'highlight.js/lib/core'
import json from 'highlight.js/lib/languages/json'

hljs.registerLanguage('json', json)

document.querySelectorAll('pre').forEach((el) => hljs.highlightBlock(el))

function downloadExtraList(filename: string, entry: object) {
  const a = document.createElement('a')
  const blob = new Blob([JSON.stringify(entry)], { type: 'application/json' })
  a.download = filename
  a.href = URL.createObjectURL(blob)
  a.click()
  a.remove()
}

document
  .querySelector('#download-extra-list-union')
  ?.addEventListener('click', () => {
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
  ?.addEventListener('click', () => {
    downloadExtraList(`${globalThis.blessing.site_name}.json`, {
      name: globalThis.blessing.site_name,
      type: 'CustomSkinAPI',
      root: `${globalThis.blessing.base_url}/csl/`,
    })
  })
