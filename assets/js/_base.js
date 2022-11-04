// let - const
const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

const dropdownList = $$('.dropdown')
const toastMain = $('#toast')

const modal = $('.modal')
const modalOverlay = $('.modal__overlay')
const modalBtnOpenList = $$('.modal__btn-open')
const modalBtnClose = $('.modal__btn-close')

const inputPasswordIconList = $$('.input-field__icon')
const tabItemList = $$('.tab__item')
const tabPaneList = $$('.tab__pane')
const tabItemActive = $('.tab__item.active')
const tabLine = $('.tab__line')

const paginationItemHiddenList = $$('.pagination__item.hidden')
// end let - const

// function
const removeActive = (list) => {
	list.forEach((item) => item.classList.remove('active'))
}

const showDropdown = (dropdownList) => {
	dropdownList.forEach((dropdown, index) => {
		if (!dropdown.classList.contains('readonly')) {
			dropdown.onclick = (e) => {
				dropdownList.forEach((item, idx) => {
					if (idx !== index) {
						item.classList.remove('active')
					}
				})

				dropdown.classList.toggle('active')
				const dropdownSelected = dropdown.querySelector('.dropdown__selected')
				const dropdownItemList = dropdown.querySelectorAll('.dropdown__item')
				const dropdownInput = dropdown.querySelector('.dropdown__input')

				dropdownSelectedClick(dropdownSelected, dropdownInput, dropdownItemList)

				if (e.target.classList.contains('dropdown__item')) {
					dropdown.classList.remove('active')
				}
			}
		}
	})
}

const dropdownSelectedClick = (
	dropdownSelected,
	dropdownInput,
	dropdownItemList,
) => {
	dropdownItemList.forEach((dropdownItem) => {
		dropdownItem.onclick = () => {
			const dropdownItemText = dropdownItem.querySelector('.dropdown__text')

			dropdownSelected.textContent = dropdownItemText.textContent
			dropdownInput.value = dropdownItemText.dataset.value
			removeActive(dropdownItemList)
			dropdownItem.classList.add('active')

			const cartRowForm = dropdownSelected.parentNode.parentNode.parentNode
			if (cartRowForm) {
				const cartRowInput = cartRowForm.querySelector('.cart__row-submit')
				if (cartRowInput) {
					cartRowInput.click()
				}
			}
		}
	})
}

const closeDropdown = (dropdownList) => {
	window.onclick = (e) => {
		if (
			!e.target.classList.contains('dropdown') &&
			!e.target.classList.contains('dropdown__select-default') &&
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

const hiddenPaginationItem = (paginationItemHiddenList) => {
	paginationItemHiddenList.forEach((paginationItem) => {
		const paginationItemLink = paginationItem.querySelector('.link')

		paginationItemLink.onclick = (e) => {
			e.preventDefault()
		}
	})
}

const toast = ({ type = 'success', message = '', duration = 3000 }) => {
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

const openModal = (modal, modalBtnOpenList) => {
	modalBtnOpenList.forEach((modalBtnOpen) => {
		modalBtnOpen.onclick = () => {
			modal.classList.add('active')

			const modalDel = modal.querySelector('.delete__modal')
			if (modalBtnOpen.dataset && modalDel) {
				const modalDelName = modalDel.querySelector('.delete__modal-name')
				const modalDelId = modalDel.querySelector('.delete__modal-id')

				modalDelName.innerText = modalBtnOpen.dataset.name
				modalDelId.value = modalBtnOpen.dataset.id
			}
		}
	})
}

const closeModal = (modal, modalOverlay, modalBtnClose) => {
	modalOverlay.onclick = () => {
		modal.classList.remove('active')
	}

	modalBtnClose.onclick = () => {
		modal.classList.remove('active')
	}
}

const showHidePassword = (inputPasswordIconList) => {
	inputPasswordIconList.forEach((icon) => {
		icon.onclick = () => {
			const input = icon.parentNode.querySelector('.input-field__input')

			if (input.type === 'password') {
				input.type = 'text'
				icon.classList.remove('bx-hide')
				icon.classList.add('bx-show-alt')
			} else {
				input.type = 'password'
				icon.classList.remove('bx-show-alt')
				icon.classList.add('bx-hide')
			}
		}
	})
}

const activeLine = (tabLine, tabItemActive) => {
	tabLine.style.left = tabItemActive.offsetLeft + 'px'
	tabLine.style.width = tabItemActive.offsetWidth + 'px'
}

const activeTab = (tabItemList, tabPaneList, tabLine) => {
	tabItemList.forEach((tabItem, index) => {
		tabItem.onclick = () => {
			const tabPane = tabPaneList[index]

			removeActive(tabItemList)
			removeActive(tabPaneList)

			tabItem.classList.add('active')
			activeLine(tabLine, tabItem)
			tabPane.classList.add('active')
		}
	})
}
// end function

// show dropdown
showDropdown(dropdownList)

// close dropdown
closeDropdown(dropdownList)

if (modalBtnOpenList) {
	// open modal
	openModal(modal, modalBtnOpenList)
}

if (modalOverlay && modalBtnClose) {
	// close modal
	closeModal(modal, modalOverlay, modalBtnClose)
}

if (inputPasswordIconList) {
	// show hide password
	showHidePassword(inputPasswordIconList)
}

if (tabLine) {
	// default active line
	activeLine(tabLine, tabItemActive)
}

if (tabItemList && tabPaneList) {
	// active tab
	activeTab(tabItemList, tabPaneList, tabLine)
}

if (paginationItemHiddenList) {
	// hidden pagination item
	hiddenPaginationItem(paginationItemHiddenList)
}
