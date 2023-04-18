import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
import { Head } from '@inertiajs/react';

export default function Dashboard({ auth }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>}
        >
            <Head/>
            <div className="flex">
                <aside className="bg-white border-pink-300 focus:ring-pink-500 focus:border-pink-500 w-64 min-h-screen">
                    <div className="flex flex-col justify-between flex-1 mt-6">
                        <div>
                            <nav className="mt-2">
                                <ResponsiveNavLink href={route('profile.edit')}>
                                    Profile
                                </ResponsiveNavLink>

                                <ResponsiveNavLink method="post" href={route('logout')} as="button">
                                    Log Out
                                </ResponsiveNavLink>
                            </nav>
                        </div>
                    </div>
                </aside>
            </div>
        </AuthenticatedLayout>
    );
}
