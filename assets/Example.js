/* This example requires Tailwind CSS v2.0+ */
import { Fragment } from 'react'
import { Popover, Transition } from '@headlessui/react'
import { MenuIcon, XIcon } from '@heroicons/react/outline'

const navigation = [
    { name: 'Product', href: '#' },
    { name: 'Features', href: '#' },
    { name: 'Marketplace', href: '#' },
    { name: 'Company', href: '#' },
]

export default function Example() {
    return (
        <nav className="container flex justify-around py-8 mx-auto bg-white">
            <div>
                <h3 className="text-2xl font-medium text-blue-500">LOGO</h3>
            </div>
            <div className="space-x-8">
                <a href="">Home</a>
                <a href="">About Us</a>
                <a href="">Blogs</a>
                <a href="">Our Team</a>
                <a href="">Contact Us</a>
            </div>
        </nav>
    )
}
