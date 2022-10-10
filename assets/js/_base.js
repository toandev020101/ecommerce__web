// let - const
const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

const dropdownSelected = $('.dropdown__selected')
const dropdownItemList = $$('.dropdown__item')

const toastMain = $('#toast')
// end let - const

// function
const removeActiveDropdownItem = (dropdownItemList) => {
	dropdownItemList.forEach((dropdownItem) =>
		dropdownItem.classList.remove('active'),
	)
}

const dropdownSelectedClick = (dropdownSelected, dropdownItemList) => {
	dropdownItemList.forEach((dropdownItem) => {
		dropdownItem.onclick = () => {
			const dropdownItemText = dropdownItem.querySelector('.dropdown__text')
			dropdownSelected.textContent = dropdownItemText.textContent
			removeActiveDropdownItem(dropdownItemList)
			dropdownItem.classList.add('active')
		}
	})
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
// end function

// run click dropdown
dropdownSelectedClick(dropdownSelected, dropdownItemList)

// run toast
toast({
	type: 'success',
	message: 'Xin chào, Đức Toàn',
	duration: 4000,
})
