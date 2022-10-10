// let - const
const CBSelectAll = $('.checkbox__select-all > input')
const CBList = $$('.checkbox:not(.checkbox__select-all) > input')
let CBListChecked = []
// end let - const

// function
const allCheckedCBSelectAll = (CBSelectAll, CBList) => {
	CBList.forEach((cb, index) => {
		CBListChecked[index] = cb.checked
		cb.onchange = () => {
			const tr = cb.parentNode.parentNode.parentNode
			CBListChecked[index] = cb.checked

			if (CBListChecked.includes(false)) {
				CBSelectAll.checked = false
			} else {
				CBSelectAll.checked = true
			}

			if (cb.checked) {
				tr.classList.add('active')
			} else {
				tr.classList.remove('active')
			}
		}
	})
}

const CBSelectAllCheckedAll = (CBSelectAll, CBList) => {
	CBSelectAll.onchange = () => {
		if (CBSelectAll.checked) {
			CBList.forEach((cb, index) => {
				const tr = cb.parentNode.parentNode.parentNode

				cb.checked = true
				CBListChecked[index] = cb.checked
				tr.classList.add('active')
			})
		} else {
			CBList.forEach((cb, index) => {
				const tr = cb.parentNode.parentNode.parentNode

				cb.checked = false
				CBListChecked[index] = cb.checked
				tr.classList.remove('active')
			})
		}
	}
}
// end function

// run checked all
allCheckedCBSelectAll(CBSelectAll, CBList)
CBSelectAllCheckedAll(CBSelectAll, CBList)
