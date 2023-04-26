import React, { useState } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
import { Head } from '@inertiajs/react';
import axios from 'axios';

export default function Dashboard({ auth }) {
  const [showSidebar, setShowSidebar] = useState(false);

  const toggleSidebar = () => {
    setShowSidebar(!showSidebar);
  };
  const redirectToDiscord = () => {
    window.open('https://discord.com/channels/1100703778585464852/1100703778585464855', '_blank');
  };

  return (
    <AuthenticatedLayout user={auth.user}>
      <Head title="Dashboard" />

      <div className="relative">
        <aside
          className={`bg-white border-pink-300 focus:ring-pink-500 focus:border-pink-500 w-64 min-h-screen ${
            showSidebar ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'
          } transition-all duration-300 fixed inset-y-0 left-0 z-30 overflow-y-auto`}
        >
          <div className="flex flex-col justify-between flex-1 mt-6">
            <div>
                <div className="flex justify-end">
                <button
                    className="w-6 h-6 rounded-md text-pink-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500"
                    onClick={toggleSidebar}
                >
                    <span className="sr-only">Close sidebar</span>
                    <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                </div>
              <nav className="mt-2">
                <ResponsiveNavLink href={route('dashboard')} active={route().current('dashboard')}>
                  Dashboard
                </ResponsiveNavLink>

                <ResponsiveNavLink href={route('profile.edit')}>
                  Profile
                </ResponsiveNavLink>

                <ResponsiveNavLink onClick={redirectToDiscord}>
                  Join Discussion
                </ResponsiveNavLink>

                <ResponsiveNavLink method="post" href={route('logout')} as="button">
                  Log Out
                </ResponsiveNavLink>
              </nav>
            </div>
          </div>
        </aside>

        <div className="flex-1" style={{ left: showSidebar ? '64px' : 0 }}>
          <div className="flex justify-start">
            <button
              className="w-6 h-6 rounded-md text-pink-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500"
              onClick={toggleSidebar}
            >
              <span className="sr-only">Open sidebar</span>
              <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
    
  );
}
