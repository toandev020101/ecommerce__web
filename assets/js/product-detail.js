// let - const
const imgShow = $('.product-detail__img-item:first-child > img')
const imgList = $$('.product-detail__img-item:not(:first-child) > img')

const colorBtnList = $$('.product-detail__info-color-item')
const descriptionBtn = $('.product-detail__description-btn > a')
const descriptionContent = $('.product-detail__description-content')

const products = [
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
	},
	{
		img: './assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
		name: 'JBL TUNE 750BTNC',
		old_price: '1.000.0000',
		curr_price: '890.000',
		sold: 88,
	},
]

const productList = $('.product-list')
// end let - const

// function
const removeActiveBtn = (list) => {
	list.forEach((item) => {
		const itemBtn = item.parentNode
		itemBtn.classList.remove('active')
	})
}

const changeImgShow = (imgShow, imgList) => {
	imgList.forEach((img) => {
		const imgBtn = img.parentNode
		img.onclick = () => {
			imgShow.src = img.src
			removeActiveBtn(imgList)
			imgBtn.classList.add('active')
		}
	})
}

const showHideDescription = (descriptionBtn, descriptionContent) => {
	descriptionBtn.onclick = () => {
		descriptionContent.classList.toggle('active')
		const descriptionBtnContent = descriptionBtn.textContent
		if (descriptionBtnContent === 'Xem thêm') {
			descriptionBtn.textContent = 'Rút gọn'
		} else {
			descriptionBtn.textContent = 'Xem thêm'
		}
	}
}

const changeColorBtn = (colorBtnList) => {
	colorBtnList.forEach((colorBtn) => {
		colorBtn.onclick = () => {
			colorBtnList.forEach((colorBtn) => {
				colorBtn.classList.remove('active')
			})
			colorBtn.classList.add('active')

			const colorBtnInput = colorBtn.querySelector(
				'.product-detail__info-color-item > input',
			)

			colorBtnInput.click()
		}
	})
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
										<span class="rating product-item__rating">
											<i class='bx bxs-star'></i>
											<i class='bx bxs-star'></i>
											<i class='bx bxs-star'></i>
											<i class='bx bxs-star'></i>
											<i class='bx bx-star'></i>
										</span>

										<span class="product-item__sold">${product.sold} đã bán</span>
									</div>

									<div class="product-item__best-selling">
										<i class='bx bx-check'></i>
										<span>Bán chạy</span>
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

changeColorBtn(colorBtnList)

// show hide description
if (descriptionBtn) {
	showHideDescription(descriptionBtn, descriptionContent)
}

// render product
renderProductList(products)
