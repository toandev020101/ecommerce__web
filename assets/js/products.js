// let - const
const checkBoxLinks = $$('.products-filter__checkbox')

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
const checkBoxLinkAll = (checkBoxLinks) => {
	checkBoxLinks.forEach((checkBoxLink) => {
		checkBoxLink.onclick = () => {
			checkBoxLink.click()
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

// onclick check box to link
checkBoxLinkAll(checkBoxLinks)

// render product
renderProductList(products)
