$(document).ready(function() {
    let hotelStorage = [];
    let rate = 1;

    function renderTable(data) {
        let rows = '';
        if (data.length === 0) {
            rows = '<tr><td colspan="4" class="text-center py-5 text-muted">No hotels found matching your filters.</td></tr>';
        } else {
            $.each(data, function(i, room) {
                const isCheapest = (i === 0);
                const displayPrice = (room.total_price * rate).toLocaleString();
                const currency = ($('#currencySwitch').val() == "1") ? "USD" : "EGP";

                rows += `<tr class="${isCheapest ? 'best-value' : ''}">
                    <td>
                        <div class="fw-bold text-dark fs-5">${room.name} ${isCheapest ? '<span class="badge-best ms-2">Best Deal</span>' : ''}</div>
                        <div class="text-muted small">Via: <span class="text-primary">${room.source}</span></div>
                    </td>
                    <td><span class="badge bg-white text-dark border px-3 py-2 rounded-pill shadow-sm">${room.room_code}</span></td>
                    <td>
                        <div class="price-tag">${displayPrice} <small class="fw-normal fs-6">${currency}</small></div>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-outline-dark btn-book px-4">Book Now</button>
                    </td>
                </tr>`;
            });
        }
        $('#hotel-data').html(rows);
    }

    function loadHotels() {
        $('#sync-icon').addClass('fa-spin');
        $.getJSON('api.php', function(data) {
            hotelStorage = data;
            applyFilters();
            $('#sync-icon').removeClass('fa-spin');
        }).fail(function() {
            $('#hotel-data').html('<tr><td colspan="4" class="text-center py-5 text-danger">Failed to load data. Please try again.</td></tr>');
            $('#sync-icon').removeClass('fa-spin');
        });
    }

    function applyFilters() {
        const term = $("#hotelSearch").val().toLowerCase();
        const max = $("#priceFilter").val();
        rate = parseFloat($('#currencySwitch').val());

        const filtered = hotelStorage.filter(room => {
            const mSearch = room.name.toLowerCase().includes(term) || room.room_code.toLowerCase().includes(term);
            const mPrice = max === "all" || room.total_price <= parseFloat(max);
            return mSearch && mPrice;
        });

        renderTable(filtered);
    }

    // Initial load
    loadHotels();

    // Event Listeners
    $('#refresh-btn').click(loadHotels);
    $("#hotelSearch, #priceFilter, #currencySwitch").on("change keyup", applyFilters);
});