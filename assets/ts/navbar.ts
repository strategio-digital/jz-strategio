/**
 * Copyright (c) 2023 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.dev, jz@strategio.dev)
 */
import { useScroll } from '@/assets/ts/scroll'

export const useNavbar = () => {
    const scroll = useScroll()

    const el = document.querySelector('.navbar') as HTMLDivElement
    const navbarToggle = el.querySelector('.navbar-hamburger') as HTMLButtonElement
    const body = document.querySelector('body') as HTMLBodyElement
    const links = Array.from(el.querySelectorAll('.navbar-content [data-navbar-link]')) as HTMLAnchorElement[]

    const bgAppendOffset = 50
    const bgStickyOffset = 100

    let lastScrollTop = 0
    let hideScrollBreakPoint = bgStickyOffset

    function closeNavbar(): void {
        el.classList.remove('active')
        navbarToggle.classList.remove('active')
        body.style.overflow = 'auto'
        //body.style.paddingRight = '0'
    }

    function openNavbar(): void {
        el.classList.add('active')
        navbarToggle.classList.add('active')
        body.style.overflow = 'hidden'
        //body.style.paddingRight = '15px'
    }

    function registerEvents(): void {
        navbarToggle.addEventListener('click', () => {
            if (el.classList.contains('active')) {
                closeNavbar()
            } else {
                openNavbar()
            }
        })

        links.map((link) => link.addEventListener('click', (e) => {
            const hash = link.href.split('#')[1]
            if (hash && document.querySelector('#' + hash)) {
                e.preventDefault()
                closeNavbar()
                scroll.scrollTo('#' + hash)
            }
        }))

        document.addEventListener('keyup', (e) => {
            if (e.key === 'Escape' && el.classList.contains('active')) {
                closeNavbar()
            }
        })

        document.addEventListener('scroll', () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop
            const direction = scroll.scrollDirection()

            if (scrollTop <= bgAppendOffset) {
                el.classList.remove('show-bg')
            } else {
                el.classList.add('show-bg')
            }

            if (direction === 'up') {
                el.classList.remove('hidden')
                hideScrollBreakPoint = scrollTop + bgStickyOffset
            } else if (direction === 'down' && scrollTop > hideScrollBreakPoint) {
                el.classList.add('hidden')
            }

            lastScrollTop = scrollTop
        })

        document.addEventListener('DOMContentLoaded', () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop
            el.classList.remove('hidden')
            if (scrollTop > bgAppendOffset) {
                el.classList.add('show-bg')
            }
        })
    }

    return {
        registerEvents,
        closeNavbar,
        openNavbar
    }
}