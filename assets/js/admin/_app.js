// let - const
const uploadInputList = $$('.upload__input')
const resetFormBtn = $('.reset__btn')
// end let - const

// function
const uploadFile = (uploadInputList) => {
	uploadInputList.forEach((uploadInput) => {
		uploadInput.onchange = () => {
			const upload = uploadInput.parentNode
			const uploadName = upload.querySelector('.upload__name')

			const uploadCloseBtn = upload.querySelector('.upload__close')
			const uploadImg = upload.querySelector('.upload__img')
			const uploadContent = upload.querySelector('.upload__content')

			const file = uploadInput.files[0]
			const filePath = uploadInput.value

			if (file) {
				const reader = new FileReader()
				reader.onload = () => {
					const result = reader.result
					uploadImg.src = result
				}
				reader.readAsDataURL(file)

				upload.classList.add('active')
				uploadImg.classList.add('active')
				uploadContent.classList.add('hidden')
				uploadInput.setAttribute('hidden', 'true')

				// delete upload file
				uploadCloseBtn.onclick = () => {
					uploadImg.src = ''
					upload.classList.remove('active')
					uploadImg.classList.remove('active')
					uploadContent.classList.remove('hidden')
					uploadInput.removeAttribute('hidden')
				}
			}

			if (filePath) {
				const fileArr = filePath.split('\\')
				const fileName = fileArr[fileArr.length - 1]
				uploadName.textContent = fileName
			}
		}
	})
}

const resetForm = (resetFormBtn) => {
	resetFormBtn.onclick = () => {
		const form = resetFormBtn.parentNode.parentNode
		const uploadList = form.querySelectorAll('.upload')
		uploadList.forEach((upload) => {
			const uploadImg = upload.querySelector('.upload__img')
			const uploadContent = upload.querySelector('.upload__content')
			const uploadInput = upload.querySelector('.upload__input')
			uploadImg.src = ''
			upload.classList.remove('active')
			uploadImg.classList.remove('active')
			uploadContent.classList.remove('hidden')
			uploadInput.removeAttribute('hidden')
		})

		const dropdownList = form.querySelectorAll('.dropdown')
		dropdownList.forEach((dropdown) => {
			const dropdownSelected = dropdown.querySelector('.dropdown__selected')
			const dropdownItemList = dropdown.querySelectorAll('.dropdown__item')
			const dropdownText = dropdown.querySelector('.dropdown__text')

			removeActive(dropdownItemList)
			dropdownItemList[0].classList.add('active')
			dropdownSelected.innerText = dropdownText.innerText
		})

		const textEditorContent = form.querySelector('.text-editor__content')
		if (textEditorContent) {
			textEditorContent.innerHTML = ''
		}
	}
}
// end function

//run upload
if (uploadInputList) {
	uploadFile(uploadInputList)
}

// run reset form
if (resetFormBtn) {
	resetForm(resetFormBtn)
}
