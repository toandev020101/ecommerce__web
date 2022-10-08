// let - const
const quantityPlusBtnList = $$('.quantity__btn-plus')
const quantityMinusBtnList = $$('.quantity__btn-minus')
const quantityMax = $('.product-detail__info-quantity-current')
// end let - const

// function
const quantityPlusBtnClick = (quantityPlusBtnList) => {
	quantityPlusBtnList.forEach((quantityPlusBtn) => {
		quantityPlusBtn.onclick = () => {
			const quantity = quantityPlusBtn.parentNode
			const quantityNum = quantity.querySelector('.quantity__number')
			const quantityMinusBtn = quantity.querySelector('.quantity__btn-minus')

			const quantityNumContent = parseInt(quantityNum.textContent)
			const quantityMaxContent = quantityMax
				? parseInt(quantityMax.textContent)
				: 99

			if (quantityNumContent === quantityMaxContent) {
				return
			} else if (quantityNumContent === quantityMaxContent - 1) {
				quantityPlusBtn.classList.add('disabled')
			} else if (quantityNumContent === 1) {
				quantityMinusBtn.classList.remove('disabled')
			}

			quantityNum.textContent = quantityNumContent + 1
		}
	})
}

const quantityMinusBtnClick = (quantityMinusBtnList) => {
	quantityMinusBtnList.forEach((quantityMinusBtn) => {
		quantityMinusBtn.onclick = () => {
			const quantity = quantityMinusBtn.parentNode
			const quantityNum = quantity.querySelector('.quantity__number')
			const quantityPlusBtn = quantity.querySelector('.quantity__btn-plus')

			const quantityNumContent = parseInt(quantityNum.textContent)
			const quantityMaxContent = quantityMax
				? parseInt(quantityMax.textContent)
				: 99

			if (quantityNumContent === 1) {
				return
			} else if (quantityNumContent === 2) {
				quantityMinusBtn.classList.add('disabled')
			} else if (quantityNumContent === quantityMaxContent) {
				quantityPlusBtn.classList.remove('disabled')
			}

			quantityNum.textContent = quantityNumContent - 1
		}
	})
}
// end function

// run quantity btn
quantityPlusBtnClick(quantityPlusBtnList)
quantityMinusBtnClick(quantityMinusBtnList)
