import { useState } from 'react';
import ApplicationLogo from '@/Components/ApplicationLogo';
import Dropdown from '@/Components/Dropdown';
import NavLink from '@/Components/NavLink';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
import { Link } from '@inertiajs/react';

export default function Authenticated({ user, header, children }) {
    const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);
    const [showingSidebar, setShowingSidebar] = useState(false);

    return (
        <div className="min-h-screen bg-green-100">
            <nav className="bg-blue-100 border-b border-pink-300">
                <div className="mx-auto px-4 sm:px-6 lg:px-8">
                <div className="flex justify-between h-16">
                    <div className="flex items-left">
                        <Link href="/dashboard">
                            <h1 className="block px-2 py-5 text-center font-bold text-pink-600 opacity-80 hover:opacity-80 dark:text-white-400 dark:hover:text-black ml-2">SpellGo</h1>
                        </Link>
                        <Link href="/dashboard">
                            <ApplicationLogo className="block h-9 w-auto fill-current text-gray-800" />
                        </Link>
                    </div>
                </div>
            </div>
            </nav>
            {header && (
                <header className="bg-white shadow">
                    <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">{header}</div>
                </header>
            )}

            <main>{children}</main>
        </div>
    );
}
