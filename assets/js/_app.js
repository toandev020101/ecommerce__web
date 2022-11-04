// let - const
const quantityPlusBtnList = $$('.quantity__btn-plus')
const quantityMinusBtnList = $$('.quantity__btn-minus')
const quantityMax = $('.product-detail__info-quantity-current')

const cartRemoveBtnList = $$('.cart__item-remove')
// end let - const

// function
const quantityPlusBtnClick = (quantityPlusBtnList) => {
	quantityPlusBtnList.forEach((quantityPlusBtn) => {
		quantityPlusBtn.onclick = () => {
			const quantity = quantityPlusBtn.parentNode
			const quantityNum = quantity.querySelector('.quantity__number')
			const quantityMinusBtn = quantity.querySelector('.quantity__btn-minus')
			const quantityInput = quantity.querySelector('.quantity__input')

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
			quantityInput.value = quantityNumContent + 1

			const cartRow = quantity.parentNode.parentNode
			if (cartRow) {
				const currentPrice = cartRow.querySelector('.cart__current-price')
				const totalPrice = cartRow.querySelector('.cart__total-price')
				if (currentPrice && totalPrice) {
					let currentPriceContent = currentPrice.textContent
					currentPriceContent = currentPriceContent.slice(
						0,
						currentPriceContent.length - 1,
					)
					currentPriceContent = currentPriceContent.replaceAll(',', '')
					const currentPriceNum = parseInt(currentPriceContent)

					const totalPriceCurrent = currentPriceNum * (quantityNumContent + 1)
					totalPrice.textContent =
						totalPriceCurrent.toLocaleString('en-US') + 'đ'
				}
			}

			const cartRowForm = quantity.parentNode
			if (cartRowForm) {
				const cartRowInput = cartRowForm.querySelector('.cart__row-submit')
				if (cartRowInput) {
					cartRowInput.click()
				}
			}
		}
	})
}

const quantityMinusBtnClick = (quantityMinusBtnList) => {
	quantityMinusBtnList.forEach((quantityMinusBtn) => {
		quantityMinusBtn.onclick = () => {
			const quantity = quantityMinusBtn.parentNode
			const quantityNum = quantity.querySelector('.quantity__number')
			const quantityPlusBtn = quantity.querySelector('.quantity__btn-plus')
			const quantityInput = quantity.querySelector('.quantity__input')

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
			quantityInput.value = quantityNumContent - 1

			const cartRow = quantity.parentNode.parentNode
			if (cartRow) {
				const currentPrice = cartRow.querySelector('.cart__current-price')
				const totalPrice = cartRow.querySelector('.cart__total-price')
				if (currentPrice && totalPrice) {
					let currentPriceContent = currentPrice.textContent
					currentPriceContent = currentPriceContent.slice(
						0,
						currentPriceContent.length - 1,
					)
					currentPriceContent = currentPriceContent.replaceAll(',', '')
					const currentPriceNum = parseInt(currentPriceContent)

					const totalPriceCurrent = currentPriceNum * (quantityNumContent - 1)
					totalPrice.textContent =
						totalPriceCurrent.toLocaleString('en-US') + 'đ'
				}
			}

			const cartRowForm = quantity.parentNode
			if (cartRowForm) {
				const cartRowInput = cartRowForm.querySelector('.cart__row-submit')
				if (cartRowInput) {
					cartRowInput.click()
				}
			}
		}
	})
}

const removeProductCart = (cartRemoveBtnList) => {
	cartRemoveBtnList.forEach((cartRemoveBtn) => {
		cartRemoveBtn.onclick = () => {
			const form = cartRemoveBtn.parentNode
			const submitInput = form.querySelector('input')

			submitInput.click()
		}
	})
}
// end function

// run quantity btn
quantityPlusBtnClick(quantityPlusBtnList)
quantityMinusBtnClick(quantityMinusBtnList)

// remove product in cart
removeProductCart(cartRemoveBtnList)
