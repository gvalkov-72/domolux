document.addEventListener('DOMContentLoaded', function() {

    // Галерия
    const imageInput = document.querySelector('input[name="images[]"]');
    const galleryContainer = document.querySelector('.property-gallery-preview');

    if (imageInput && galleryContainer) {
        imageInput.addEventListener('change', function(e) {
            galleryContainer.innerHTML = '';
            Array.from(e.target.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('position-relative', 'me-2', 'mb-2', 'image-preview-wrapper');

                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.width = 100;
                    img.height = 70;
                    img.classList.add('border', 'rounded');
                    wrapper.appendChild(img);

                    const coverBtn = document.createElement('button');
                    coverBtn.type = 'button';
                    coverBtn.innerText = 'Cover';
                    coverBtn.classList.add('btn', 'btn-sm', 'btn-success', 'position-absolute', 'bottom-0', 'start-0');
                    coverBtn.addEventListener('click', function() {
                        document.querySelectorAll('.image-preview-wrapper').forEach(el => el.classList.remove('cover'));
                        wrapper.classList.add('cover');
                        document.querySelectorAll('input[name="images[]"]').forEach(input => input.dataset.coverIndex = index);
                    });
                    wrapper.appendChild(coverBtn);

                    galleryContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        });
    }

    // Автоматично пресмятане на евро от лева
    const priceLvInput = document.querySelector('input[name="price_lv"]');
    const priceEurInput = document.querySelector('input[name="price_eur"]');
    const exchangeRate = parseFloat(document.querySelector('input[name="exchange_rate"]').value) || 1.95583;

    if (priceLvInput && priceEurInput) {
        priceLvInput.addEventListener('input', function() {
            const lv = parseFloat(this.value) || 0;
            priceEurInput.value = (lv / exchangeRate).toFixed(2);
        });
    }
});
