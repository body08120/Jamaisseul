toggleDropdowns()
hideAllDropdowns()       

function toggleDropdowns()
{
    const teamCard = document.querySelectorAll('.team-card')

    teamCard.forEach(card => {
        let dropdownArrow = card.querySelector('.fa-chevron-down')
        let closeArrow = card.querySelector('.fa-chevron-up')
        const dropdownContent = card.querySelector('.dropdown-content') 

            dropdownArrow.addEventListener('click', e => {
                hideAllDropdowns()
                dropdownContent.style.display = "block"
                dropdownArrow.style.opacity ="0"
            })
            closeArrow.addEventListener('click',hideAllDropdowns)
    })
}

function hideAllDropdowns()
{
    const dropdowns = document.querySelectorAll('.dropdown-content')
    dropdowns.forEach(dropdown => dropdown.style.display = "none")
    const dropdownOpen = document.querySelectorAll('.team-card .fa-chevron-down')
    dropdownOpen.forEach(arrow => arrow.style.opacity = "100")
}
