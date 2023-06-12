toggleDropdowns()
hideAllDropdowns()       

function toggleDropdowns()
{
    const teamCard = document.querySelectorAll('.team-card')

    teamCard.forEach(card => {
        let dropdownArrow = card.querySelector('.fa-chevron-down')
        const dropdownContent = card.querySelector('.dropdown-content') 

        dropdownArrow.addEventListener('click', e => {
            if(dropdownContent.classList.contains('d-none')){
                hideAllDropdowns()
            }
            dropdownContent.classList.toggle('d-none')
            dropdownArrow.classList.toggle('close-arrow')
        })
    })
}

function hideAllDropdowns()
{
    const dropdowns = document.querySelectorAll('.dropdown-content')
    dropdowns.forEach(dropdown => dropdown.classList.add('d-none'))
    const dropdownOpen = document.querySelectorAll('.team-card .fa-chevron-down')
    dropdownOpen.forEach(arrow => arrow.classList.remove('close-arrow'))
}
