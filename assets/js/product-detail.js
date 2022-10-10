// let - const
const imgShow = $('.product-detail__img-item:first-child > img')
const imgList = $$('.product-detail__img-item:not(:first-child) > img')

const copyInput = $('.product-detail__info-copy-text')
const copyBtn = $('.product-detail__info-copy')

const colorBtnList = $$('.product-detail__info-color-item > button')
const descriptionBtn = $('.product-detail__description-btn')
const description = $('.product-detail__description')

const products = [
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
		brand: 'JBL',
		origin: 'Nhật bản',
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
		brand: 'JBL',
		origin: 'Nhật bản',
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
		brand: 'JBL',
		origin: 'Nhật bản',
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
		brand: 'JBL',
		origin: 'Nhật bản',
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
		brand: 'JBL',
		origin: 'Nhật bản',
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
		brand: 'JBL',
		origin: 'Nhật bản',
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
		brand: 'JBL',
		origin: 'Nhật bản',
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
		brand: 'JBL',
		origin: 'Nhật bản',
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
		brand: 'JBL',
		origin: 'Nhật bản',
	},
]

const productList = $('.product-list')
// end let - const

// function
const removeActiveAllImgBtn = (imgList) => {
	imgList.forEach((img) => {
		const imgBtn = img.parentNode
		imgBtn.classList.remove('active')
	})
}

const changeImgShow = (imgShow, imgList) => {
	imgList.forEach((img) => {
		const imgBtn = img.parentNode
		img.onclick = () => {
			imgShow.src = img.src
			removeActiveAllImgBtn(imgList)
			imgBtn.classList.add('active')
		}
	})
}

const removeActiveAllColorImgBtn = (colorBtnList) => {
	colorBtnList.forEach((colorBtn) => {
		const colorImgBtn = colorBtn.parentNode
		colorImgBtn.classList.remove('active')
	})
}

const changeColorImgShow = (imgShow, colorBtnList) => {
	colorBtnList.forEach((colorBtn) => {
		const colorImgBtn = colorBtn.parentNode
		const colorImg = colorImgBtn.querySelector('img')
		const imgShowSrcDefault = imgShow.src

		colorBtn.onmouseover = () => {
			imgShow.src = colorImg.src
		}

		colorBtn.onmouseleave = () => {
			imgShow.src = imgShowSrcDefault
		}

		colorBtn.onclick = () => {
			if (!colorBtn.closest('.disabled')) {
				removeActiveAllColorImgBtn(colorBtnList)
				colorImgBtn.classList.add('active')
			}
		}
	})
}

const showHideDescription = (descriptionBtn) => {
	descriptionBtn.onclick = () => {
		description.classList.toggle('active')
		const descriptionBtnContent = descriptionBtn.textContent
		if (descriptionBtnContent === 'Xem thêm') {
			descriptionBtn.textContent = 'Rút gọn'
		} else {
			descriptionBtn.textContent = 'Xem thêm'
		}
	}
}

const copyClick = (copyBtn, copyInput) => {
	copyBtn.onclick = () => {
		const text = copyInput.value
		copyInput.select()
		navigator.clipboard.writeText(text)

		copyInput.value = 'Copied!'
		setTimeout(() => (copyInput.value = text), 1500)
	}
}

const renderProductList = (products) => {
	products.forEach((product) => {
		let prod = `<a href="#" class="link product-item">
									<div class="product-item__img"
										style="background-image: url(${product.img});">
									</div>

									<h4 class="product-item__name">
										${product.name}
									</h4>

									<div class="product-item__price">
										<span class="product-item__price-old">${product.old_price}đ</span>
										<span class="product-item__price-current">${product.curr_price}đ</span>
									</div>

									<div class="product-item__action">
										<i class='bx bx-heart product-item__heart'></i>

										<span class="rating product-item__rating">
											<i class='bx bxs-star'></i>
											<i class='bx bxs-star'></i>
											<i class='bx bxs-star'></i>
											<i class='bx bxs-star'></i>
											<i class='bx bx-star'></i>
										</span>

										<span class="product-item__sold">${product.sold} đã bán</span>
									</div>

									<div class="product-item__origin-wrapper">
										<span class="product-item__brand">${product.brand}</span>
										<span class="product-item__origin">${product.origin}</span>
									</div>

									<div class="product-item__favourite">
										<i class='bx bx-check'></i>
										<span>Yêu thích</span>
									</div>

									<div class="product-item__sale-off">
										<span class="product-item__percent">10%</span>
										<div class="product-item__text">Giảm</div>
									</div>
								</a>`
		productList.insertAdjacentHTML('beforeend', prod)
	})
}
// end function

// run img show
changeImgShow(imgShow, imgList)
changeColorImgShow(imgShow, colorBtnList)

// show hide description
showHideDescription(descriptionBtn)

// copy voucher
copyClick(copyBtn, copyInput)

// render product
renderProductList(products)
