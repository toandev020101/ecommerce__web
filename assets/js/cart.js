// let - const
const CBSelectAll = $('.checkbox__select-all > input')
const CBList = $$('.checkbox:not(.checkbox__select-all) > input')
let CBListChecked = []

const actionNum = $('.cart__action-product-number')
const totalProduct = $('.cart__action-total-product')
const totalPrice = $('.cart__action-total-price')
// end let - const

// function
const CBListCheckedTrueQuantity = (CBListChecked) => {
	let dem = 0
	CBListChecked.forEach((CBChecked) => {
		if (CBChecked) {
			dem++
		}
	})
	return dem
}

const allCheckedCBSelectAll = (
	CBSelectAll,
	CBList,
	actionNum,
	totalProduct,
	totalPrice,
) => {
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

			// số lượng trên 1 dòng
			const quantityNumber = tr.querySelector('.quantity__number')
			const quantityNum = parseInt(quantityNumber.textContent)

			// giá trên 1 dòng
			const totalPriceRow = tr.querySelector('.cart__total-price')
			let totalPriceRowTextContent = totalPriceRow.textContent
			totalPriceRowTextContent = totalPriceRowTextContent.replace('đ', '')
			const totalPriceRowNum = parseInt(
				totalPriceRowTextContent.replaceAll(',', ''),
			)

			//tổng số lượng hiện tại
			const totalProductNum = parseInt(totalProduct.textContent)

			// tổng tiền hiện tại
			let totalPriceTextContent = totalPrice.textContent
			totalPriceTextContent = totalPriceTextContent.replace('đ', '')
			const totalPriceNum = parseInt(totalPriceTextContent.replaceAll(',', ''))
			if (cb.checked) {
				tr.classList.add('active')

				totalProduct.textContent = totalProductNum + quantityNum

				totalPrice.textContent =
					(totalPriceNum + totalPriceRowNum).toLocaleString('en-US') + 'đ'
			} else {
				tr.classList.remove('active')

				totalProduct.textContent = totalProductNum - quantityNum

				totalPrice.textContent =
					(totalPriceNum - totalPriceRowNum).toLocaleString('en-US') + 'đ'
			}

			actionNum.textContent = CBListCheckedTrueQuantity(CBListChecked)
		}
	})
}

const CBSelectAllCheckedAll = (CBSelectAll, CBList, actionNum) => {
	CBSelectAll.onchange = () => {
		if (CBSelectAll.checked) {
			let totalProductNum = 0
			let totalPriceNum = 0

			CBList.forEach((cb, index) => {
				const tr = cb.parentNode.parentNode.parentNode

				cb.checked = true
				CBListChecked[index] = cb.checked
				tr.classList.add('active')

				// số lượng trên 1 dòng
				const quantityNumber = tr.querySelector('.quantity__number')
				const quantityNum = parseInt(quantityNumber.textContent)

				totalProductNum += quantityNum

				// giá trên 1 dòng
				const totalPriceRow = tr.querySelector('.cart__total-price')
				let totalPriceRowTextContent = totalPriceRow.textContent
				totalPriceRowTextContent = totalPriceRowTextContent.replace('đ', '')
				const totalPriceRowNum = parseInt(
					totalPriceRowTextContent.replaceAll(',', ''),
				)

				totalPriceNum += totalPriceRowNum
			})

			totalProduct.textContent = totalProductNum

			totalPrice.textContent = totalPriceNum.toLocaleString('en-US') + 'đ'
		} else {
			CBList.forEach((cb, index) => {
				const tr = cb.parentNode.parentNode.parentNode

				cb.checked = false
				CBListChecked[index] = cb.checked
				tr.classList.remove('active')
			})

			totalProduct.textContent = 0

			totalPrice.textContent = 0 + 'đ'
		}

		actionNum.textContent = CBListCheckedTrueQuantity(CBListChecked)
	}
}

const checkActionNumClickOrderBtn = (orderBtn, actionNum) => {
	if (parseInt(actionNum.textContent) == 0) {
		orderBtn.type = 'button'
	}
}
// end function

// run checked all
allCheckedCBSelectAll(CBSelectAll, CBList, actionNum, totalProduct, totalPrice)
CBSelectAllCheckedAll(CBSelectAll, CBList, actionNum)
