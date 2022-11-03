// let - const
const checkBoxLinks = $$('.products-filter__checkbox')
const priceInputList = $$('.products-filter__input')
const priceBtn = $('.products-filter__btn-price')
const priceError = $('.products-filter__error')

// end let - const

// function
const checkBoxLinkAll = (checkBoxLinks) => {
	checkBoxLinks.forEach((checkBoxLink) => {
		checkBoxLink.onclick = () => {
			checkBoxLink.click()
		}
	})
}

const changeHrefPriceBtn = (priceBtn, priceInputList) => {
	priceInputList.forEach((priceInput) => {
		priceInput.onkeyup = () => {
			priceError.classList.remove('active')
		}
	})

	priceInputList[0].onchange = () => {
		priceBtn.href += 'price_from=' + priceInputList[0].value
	}

	priceInputList[1].onchange = () => {
		priceBtn.href += '&price_to=' + priceInputList[1].value
	}

	// check error
	priceBtn.onclick = (e) => {
		if (priceInputList[0].value == '' || priceInputList[1].value == '') {
			e.preventDefault()
			priceError.classList.add('active')
		}
	}
}
// end function

// onclick check box to link
checkBoxLinkAll(checkBoxLinks)

// price from to
changeHrefPriceBtn(priceBtn, priceInputList)
