// let - const
const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

const dropdownList = $$('.dropdown')
const toastMain = $('#toast')
const modal = $('.modal')
const modalOverlay = $('.modal__overlay')
const modalBtnOpen = $('.modal__btn-open')
const modalBtnClose = $('.modal__btn-close')
// end let - const

// function
const removeActive = (list) => {
	list.forEach((item) => item.classList.remove('active'))
}

const showDropdown = (dropdownList) => {
	dropdownList.forEach((dropdown, index) => {
		dropdown.onclick = (e) => {
			dropdownList.forEach((item, idx) => {
				if (idx !== index) {
					item.classList.remove('active')
				}
			})

			dropdown.classList.toggle('active')
			const dropdownSelected = dropdown.querySelector('.dropdown__selected')
			const dropdownItemList = dropdown.querySelectorAll('.dropdown__item')
			dropdownSelectedClick(dropdownSelected, dropdownItemList)

			if (e.target.classList.contains('dropdown__item')) {
				dropdown.classList.remove('active')
			}
		}
	})
}

const dropdownSelectedClick = (dropdownSelected, dropdownItemList) => {
	dropdownItemList.forEach((dropdownItem) => {
		dropdownItem.onclick = () => {
			const dropdownItemText = dropdownItem.querySelector('.dropdown__text')
			dropdownSelected.textContent = dropdownItemText.textContent
			removeActive(dropdownItemList)
			dropdownItem.classList.add('active')
		}
	})
}

const closeDropdown = (dropdownList) => {
	window.onclick = (e) => {
		if (
			!e.target.classList.contains('dropdown') &&
			!e.target.classList.contains('dropdown__select') &&
			!e.target.classList.contains('dropdown__selected') &&
			!e.target.classList.contains('bx') &&
			!e.target.classList.contains('dropdown__list') &&
			!e.target.classList.contains('dropdown__item')
		) {
			removeActive(dropdownList)
		}
	}
}

const toast = ({ type = 'success', message = '', duration = 4000 }) => {
	if (toastMain) {
		const toastElement = document.createElement('div')
		const icons = {
			success: 'bx bxs-check-circle',
			info: 'bx bxs-info-circle',
			warning: 'bx bxs-error',
			error: 'bx bxs-info-circle',
		}

		const icon = icons[type]
		const delay = (duration / 1000).toFixed(2)

		toastElement.classList.add('toast', `toast--${type}`)
		toastElement.style.animation = `slideInLeft 0.3s ease, fadeOut 1s ${delay}s linear forwards`

		toastElement.innerHTML = `
			<div class="toast__icon">
				<i class='${icon}'></i>
			</div>
			<div class="toast__msg">${message}</div>
			<div class="toast__close">
				<i class='bx bx-x'></i>
			</div>
			<div class="toast__progress">
				<p class="toast__progress-timing"></p>
			</div>
		`

		toastMain.appendChild(toastElement)

		const toastProgressTiming = toastElement.querySelector(
			'.toast__progress-timing',
		)
		toastProgressTiming.style.animation = `progressing ${delay}s linear forwards`

		// auto remove
		let autoRemoveId = setTimeout(
			() => toastMain.removeChild(toastElement),
			duration + 1000,
		)

		let delayAnimation = new Date().getMilliseconds()

		// paused animation
		toastMain.onmouseover = () => {
			toastElement.style.animationPlayState = 'paused'
			clearTimeout(autoRemoveId)
			delayAnimation = new Date().getMilliseconds() - delayAnimation
			toastProgressTiming.style.animationPlayState = 'paused'
		}

		// running animation
		toastMain.onmouseleave = () => {
			toastElement.style.animationPlayState = 'running'
			const continueAnimation = (duration - delayAnimation).toFixed(2)
			autoRemoveId = setTimeout(
				() => toastMain.removeChild(toastElement),
				continueAnimation,
			)
			toastProgressTiming.style.animationPlayState = 'running'
		}

		// remove clicked close icon
		toastElement.onclick = (e) => {
			if (e.target.closest('.toast__close')) {
				toastMain.removeChild(toastElement)
				clearTimeout(autoRemoveId)
			}
		}
	}
}

const openModal = (modal, modalBtnOpen) => {
	modalBtnOpen.onclick = () => {
		modal.classList.add('active')
	}
}

const closeModal = (modal, modalOverlay, modalBtnClose) => {
	modalOverlay.onclick = () => {
		modal.classList.remove('active')
	}

	modalBtnClose.onclick = () => {
		modal.classList.remove('active')
	}
}
// end function

// show dropdown
showDropdown(dropdownList)

// close dropdown
closeDropdown(dropdownList)

// run toast
toast({
	type: 'success',
	message: 'Xin chào, Đức Toàn',
	duration: 4000,
})

if (modalBtnOpen) {
	// open modal
	openModal(modal, modalBtnOpen)
}

if (modalOverlay && modalBtnClose) {
	// close modal
	closeModal(modal, modalOverlay, modalBtnClose)
}
