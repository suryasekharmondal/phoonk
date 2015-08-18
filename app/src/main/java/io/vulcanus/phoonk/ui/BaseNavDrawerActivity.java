/*
 * Copyright 2015 Abhishek Dabholkar
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

package io.vulcanus.phoonk.ui;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.support.annotation.IdRes;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBar;
import android.view.MenuItem;

import io.vulcanus.phoonk.R;

/**
 * Provides common navigation drawer functionality across required activities.
 */
public class BaseNavDrawerActivity extends BaseActivity {

    // A close delay (in millis) which ensures that the nav drawer has completed it's close
    // animation before proceeding to start an activity.
    public static final int NAVDRAWER_CLOSE_DELAY = 250;

    // A runnable that waits till the nav drawer has closed and then launches the required activity.
    private Handler mHandler;

    // All activities requiring a nav drawer will have to have a drawer layout.
    private DrawerLayout mDrawerLayout;

    // iosched pattern was great, but the design library is even better. ;-)
    private NavigationView mNavigationView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        mHandler = new Handler();
    }

    /**
     * Overrides {@link BaseActivity#setupToolbar()}
     */
    @Override
    protected void setupToolbar() {
        super.setupToolbar();
        ActionBar actionBar = getSupportActionBar();
        assert getSupportActionBar() != null;
        actionBar.setHomeAsUpIndicator(R.drawable.ic_action_menu);
        actionBar.setDisplayHomeAsUpEnabled(true);
    }

    /**
     * Setup the navigation drawer.
     */
    protected void setupNavDrawer() {
        mDrawerLayout = (DrawerLayout) findViewById(R.id.drawerLayout);
        mNavigationView = (NavigationView) findViewById(R.id.navView);
        assert mNavigationView != null;
        setupNavDrawerContent();
    }

    /**
     * Sets up the new navigation view from the android design support library.
     * Handles click events for menu items and serves to launch activities.
     */
    private void setupNavDrawerContent() {
        mNavigationView.setNavigationItemSelectedListener(
                new NavigationView.OnNavigationItemSelectedListener() {
                    @Override
                    public boolean onNavigationItemSelected(MenuItem menuItem) {
                        Intent intent = null;
                        switch (menuItem.getItemId()) {

                            case R.id.menuNavExplore :
                                if (BaseNavDrawerActivity.this instanceof ExploreActivity) {
                                    break;
                                }
                                intent = new Intent(BaseNavDrawerActivity.this, ExploreActivity.class);
                                break;

                        }
                        goToNavDrawerItem(intent);
                        closeNavDrawer();
                        return true;
                    }
                });
    }

    /**
     * Handles the actual launching of activity when requested by {@link #setupNavDrawerContent()}.
     * @param intent The required intent to launch based on request by {@link #setupNavDrawerContent()}.
     *               Declared final to be made accessible by inner class.
     */
    private void goToNavDrawerItem(final Intent intent) {
        if(intent != null) {
            mHandler.postDelayed(new Runnable() {
                @Override
                public void run() {
                    startActivity(intent);
                    finish();
                    overridePendingTransition(R.anim.activity_fade_in, R.anim.activity_fade_out);
                }
            }, NAVDRAWER_CLOSE_DELAY);
        }
    }

    /**
     * Activities call this method to set checked state for the required menu item,
     * hence giving a proper visual response to the user.
     * @param resId Resource ID of menu item to be checked.
     */
    protected void setNavItemChecked(@IdRes int resId) {
        mNavigationView.getMenu().findItem(resId).setChecked(true);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home:
                openNavDrawer();
                return true;
        }
        return super.onOptionsItemSelected(item);
    }

    @Override
    public void onBackPressed() {
        if (isNavDrawerOpen()) {
            closeNavDrawer();
            return;
        }
        super.onBackPressed();
    }

    /**
     * Method to get current nav drawer state
     * @return true/false based on whether nav drawer is open/closed.
     */
    protected boolean isNavDrawerOpen() {
        return mDrawerLayout.isDrawerOpen(mNavigationView);
    }

    /**
     * Opens the nav drawer.
     */
    protected void openNavDrawer() {
        mDrawerLayout.openDrawer(GravityCompat.START);
    }

    /**
     * Closes the nav drawer.
     */
    protected void closeNavDrawer() {
        mDrawerLayout.closeDrawer(GravityCompat.START);
    }
}
