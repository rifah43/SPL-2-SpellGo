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
        <div className="min-h-screen bg-orange-300" style={backgroundStyle}>
            <nav className="bg-orange-500 border-b border-pink-300">
                <div className="mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex">
                        <div className="flex items-left">
                            <Link href="/dashboard">
                                <h1 className="block px-2 py-2 text-center font-bold text-white opacity-80 hover:opacity-80 dark:text-white-400 dark:hover:text-black ml-2">SpellGo</h1>
                                {header}
                                <p className="px-1 text-center font-bold text-white opacity-80 hover:opacity-80 dark:text-white-400 dark:hover:text-black ml-2">{user.name}</p>
                            </Link>
                            <Link href="/dashboard">
                                <ApplicationLogo className="block h-9 w-auto fill-current text-gray-800" />
                            </Link>
                        </div>
                    </div>
                </div>
            </nav>
            <main>{children}</main>
        </div>
    );
}
const backgroundStyle = {
    backgroundImage: 'url(dbg.png)',
    backgroundSize: 'cover',
    backgroundPosition: 'center',
  };
