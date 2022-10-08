// let - const
const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

const dropdownSelected = $('.dropdown__selected')
const dropdownItemList = $$('.dropdown__item')
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
// end function

// run click dropdown
dropdownSelectedClick(dropdownSelected, dropdownItemList)
