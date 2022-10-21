// $$ - document.querySelectorAll
// $ - document.querySelector

// let - const
const textEditorBtnList = $$('.text-editor__btn')
const advTextEditorBtnList = $$('.adv-text-editor__btn')
const fontName = $('#fontName')
const fontSize = $('#fontSize')

const textEditorContent = $('.text-editor__content')
const linkBtn = $('#createLink')
const imageBtn = $('#insertImage')
const alignBtnList = $$('.align')

const spacingBtnList = $$('.spacing')
const formatBtnList = $$('.format')
const fontList = [
	'Arial',
	'Verdana',
	'Times New Roman',
	'Garamon',
	'Georgia',
	'Courier New',
	'cursive',
]
const fontSizeList = [
	'10',
	'12',
	'13',
	'14',
	'16',
	'18',
	'20',
	'22',
	'24',
	'26',
	'28',
	'36',
	'48',
	'72',
]
// end let - const

// initial settings
const initializer = () => {
	// function calls for highlighting buttons
	// no highlights for link, unlink, lists, undo, redo since they are one time operations
	highlighter(alignBtnList, true)
	highlighter(spacingBtnList, true)
	highlighter(formatBtnList, false)

	// create options for font name
	fontList.map((fontItem) => {
		let option = document.createElement('option')
		option.value = fontItem
		option.textContent = fontItem
		fontName.appendChild(option)
	})

	// fontSize allows only till 7
	fontSizeList.forEach((fontSizeItem) => {
		let option = document.createElement('option')
		option.value = fontSizeItem
		option.textContent = fontSizeItem
		fontSize.appendChild(option)
	})

	// default fontSize
	fontSize.value = 16
}

// main logic
const modifyText = (command, defaultUi, value) => {
	// execCommand executes command on selected text
	document.execCommand(command, defaultUi, value)
}

// for basic operations which don't need value parameter
textEditorBtnList.forEach((btn) => {
	btn.addEventListener('click', () => {
		modifyText(btn.id, false, null)
	})
})

// options that require value parameter (e.g colors, fonts)
advTextEditorBtnList.forEach((btn) => {
	btn.addEventListener('change', () => {
		modifyText(btn.id, false, btn.value)

		if (btn.id === 'fontSize') {
			const fontElements = $$('font')
			for (let i = 0; i < fontElements.length; ++i) {
				if (fontElements[i].size) {
					fontElements[i].style.fontSize = btn.value + 'px'
					fontElements[i].removeAttribute('size')
				}
			}
		}
	})
})

// link
linkBtn.onclick = () => {
	let url = prompt('Nhập địa chỉ url')
	if (!/http/i.test(url)) {
		url = 'http://' + url
	}
	modifyText(linkBtn.id, false, url)
}

// image link
imageBtn.onclick = () => {
	let url = prompt('Nhập địa chỉ url')
	modifyText(imageBtn.id, false, url)
}

// highlight clicked button
const highlighter = (btnList, needsRemoval) => {
	btnList.forEach((btn) => {
		btn.addEventListener('click', () => {
			// needsRemoval = true means only one button should be highlight and other would be normal
			if (needsRemoval) {
				let alreadyActive = false

				// if currently clicked button is already active
				if (btn.classList.contains('active')) {
					alreadyActive = true
				}

				// remove highlight from other buttons
				highlighterRemover(btnList)
				if (!alreadyActive) {
					// highlight clicked button
					btn.classList.add('active')
				}
			} else {
				// if other buttons can be highlighted
				btn.classList.toggle('active')
			}
		})
	})
}

const highlighterRemover = (btnList) => {
	btnList.forEach((btn) => {
		btn.classList.remove('active')
	})
}

// fontSize configs

window.onload = initializer()
